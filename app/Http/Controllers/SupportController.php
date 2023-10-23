<?php

namespace App\Http\Controllers;

use RowBloom\RowBloom\Support;

class SupportController
{
    public function __invoke(Support $support): array
    {
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
    }
}
