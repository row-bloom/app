<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\Rule;
use RowBloom\RowBloom\Config;
use RowBloom\RowBloom\RowBloom;
use RowBloom\RowBloom\Support;

class RenderController
{
    public function __construct(private RowBloom $rowBloom, private Support $support)
    {
    }

    public function __invoke(Request $request): HttpResponse
    {
        $params = $request->validate([
            'interpolator' => [
                'required',
                'string',
                Rule::in(array_keys($this->support->getInterpolatorDrivers())),
            ],
            'renderer' => [
                'required',
                'string',
                Rule::in(array_keys($this->support->getRendererDrivers())),
            ],
            'template' => ['required', 'string'],
            'css' => ['required', 'string'],
            'table' => ['required', 'array', 'min:1'],
            'table.*' => ['required', 'array'],
            'options' => ['required', 'array'],
        ]);

        $rendering = $this->rowBloom
            ->setFromArray($params)
            ->tapConfig(function (Config $config) {
                $config->chromePath = 'C:\Program Files\Google\Chrome\Application\Chrome.exe';
            })
            ->get();

        return Response::make($rendering, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="document.pdf"',
        ]);
    }
}
