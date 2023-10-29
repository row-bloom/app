<?php

namespace App\Http\Controllers;

use RowBloom\RowBloom\Support;

class SupportController
{
    public function __invoke(Support $support): array
    {
        return [
            'dataLoaderDrivers' => array_keys($support->getDataLoaderDrivers()),
            'interpolatorDrivers' => array_keys($support->getInterpolatorDrivers()),
            'rendererDrivers' => array_keys($support->getRendererDrivers()),
            'supportedTableFileExtensions' => array_keys($support->getSupportedTableFileExtensions()),
            'rendererOptionsSupport' => array_reduce(
                array_keys($support->getRendererDrivers()),
                fn(array $carry, string $driverName): array => $carry
                    + [$driverName => $support->getRendererOptionsSupport($driverName)],
                []
            ),
        ];
    }
}
