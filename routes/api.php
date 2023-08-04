<?php

use ElaborateCode\RowBloom\DataCollectors\DataCollectorFactory;
use ElaborateCode\RowBloom\Interpolators\Interpolator;
use ElaborateCode\RowBloom\Renderers\Renderer;
use ElaborateCode\RowBloom\RowBloom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::post('/render', function (Request $request) {
    $request->validate([
        'template' => ['required', 'string'],
        'css' => ['required', 'string'],
        'table' => ['required', 'array'],
        'options' => ['required', 'array'],
    ]);

    /** @var RowBloom */
    $r = app()->get(RowBloom::class);

    $r->setInterpolator(Interpolator::Php)
        ->setRenderer(Renderer::Mpdf);

    $r->addTable($request->table);
    $r->setTemplate($request->template);
    $r->addCss($request->css);

    foreach ($request->options as $option => $value) {
        $r->setOption($option, $value);
    }

    $headers = [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'inline; filename="document.pdf"'
    ];

    return Response::make($r->get(), 200, $headers);
});

Route::post('/parse-table', function (Request $request) {
    $request->validate([
        'table' => ['required', 'file'],
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
