<?php

namespace App\Http\Controllers;

use RowBloom\RowBloom\DataLoaders\DataLoaderFactory;
use RowBloom\RowBloom\Support;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RowBloom\RowBloom\Fs\File;

class ReadTableContentController
{
    public function __invoke(Request $request, Support $support): array
    {
        $request->validate([
            'table' => [
                'required',
                'file',
                'mimes:'.implode(',', array_keys($support->getSupportedTableFileExtensions())),
            ],
        ]);

        $tmpFile = $request->file('table');

        $storedName = time().'.'.$tmpFile->getClientOriginalExtension();

        $tmpFile->storeAs(
            '',
            $storedName,
            'local'
        );

        $table = app()->get(DataLoaderFactory::class)
            ->makeFromPath(storage_path('app/'.$storedName))
            ->getTable(new File(storage_path('app/'.$storedName)))
            ->toArray();

        Storage::disk('local')->delete($storedName);

        return $table;
    }
}
