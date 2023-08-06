<?php

use ElaborateCode\RowBloom\DataCollectors\DataCollectorFactory;
use ElaborateCode\RowBloom\Interpolators\Interpolator;
use ElaborateCode\RowBloom\Renderers\Renderer;
use ElaborateCode\RowBloom\RowBloom;
use ElaborateCode\RowBloom\Support;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/support', function () {
    /** @var Support */
    $support = app()->get(Support::class);

    return [
        'dataCollectorDrivers' => array_keys($support->getDataCollectorDrivers()),
        'interpolatorDrivers' => array_keys($support->getInterpolatorDrivers()),
        'rendererDrivers' => array_keys($support->getRendererDrivers()),
        'supportedTableFileExtensions' => $support->getSupportedTableFileExtensions(),
        'rendererOptionsSupport' => array_map(
            fn ($driverName) => $support->getRendererOptionsSupport($driverName),
            $support->getRendererDrivers()
        ),
    ];
});

Route::post('/render', function (Request $request) {
    $request->validate([
        'interpolatorDriver' => ['required', 'string'],
        'rendererDriver' => ['required', 'string'],
        'template' => ['required', 'string'],
        'css' => ['required', 'string'],
        'table' => ['required', 'array'],
        'options' => ['required', 'array'],
    ]);

    /** @var RowBloom */
    $r = app()->get(RowBloom::class);

    $r->setInterpolator(app()->get(Support::class)->getInterpolatorDrivers()[$request->interpolatorDriver])
        ->setRenderer(app()->get(Support::class)->getRendererDrivers()[$request->rendererDriver]);

    $r->addTable($request->table);
    $r->setTemplate($request->template);
    $r->addCss($request->css);

    foreach ($request->options as $option => $value) {
        $r->setOption($option, $value);
    }

    $headers = [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'inline; filename="document.pdf"',
    ];

    return Response::make($r->get(), 200, $headers);
});

Route::post('/parse-table', function (Request $request) {
    $request->validate([
        'table' => [
            'required',
            'file',
            'mimes:'.implode(',', array_keys(app()->get(Support::class)->getSupportedTableFileExtensions())),
        ],
    ]);

    $tmpFile = $request->file('table');

    $storedName = time().'.'.$tmpFile->getClientOriginalExtension();

    $tmpFile->storeAs(
        '',
        $storedName,
        'local'
    );

    $table = app()->get(DataCollectorFactory::class)
        ->makeFromPath(storage_path('app/'.$storedName))
        ->getTable(storage_path('app/'.$storedName))
        ->toArray();

    Storage::disk('local')->delete($storedName);

    return $table;
});
