<?php

use ElaborateCode\RowBloom\DataCollectors\DataCollectorFactory;
use ElaborateCode\RowBloom\RowBloom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/render', function (Request $request) {
    return $request->all();
});

Route::post('/parse-table', function (Request $request) {
    $request->validate([
        'table' => ['required', 'file'],
    ]);

    $tableFile = $request->file('table');

    $newName = time().'.'.$tableFile->getClientOriginalExtension();

    $tableFile->storeAs(
        '',
        $newName,
        'local'
    );

    /** @var RowBloom */
    $r = app()->get(RowBloom::class);

    /** @var DataCollectorFactory */
    $rdcf = app()->get(DataCollectorFactory::class);

    $dc = $rdcf->makeFromPath(storage_path('app/'.$newName));

    return $dc->getTable(storage_path('app/'.$newName))->toArray();
});
