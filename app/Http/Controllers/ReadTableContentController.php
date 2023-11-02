<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RowBloom\RowBloom\DataLoaders\DataLoaderFactory;
use RowBloom\RowBloom\Support;
use RowBloom\RowBloom\Types\TableLocation;

class ReadTableContentController
{
    public function __construct(private DataLoaderFactory $dataLoaderFactory)
    {

    }

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

        $tmpFile->storeAs('', $storedName, 'local');

        $tableLocation = TableLocation::make(storage_path('app/'.$storedName));

        $table = $this->dataLoaderFactory
            ->makeFromLocation($tableLocation)
            ->getTable($tableLocation)
            ->toArray();

        Storage::disk('local')->delete($storedName);

        return $table;
    }
}
