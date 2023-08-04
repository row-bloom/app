<?php

use ElaborateCode\RowBloom\DataCollectors\DataCollectorFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::post('/render', function (Request $request) {
    return $request->all();
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
