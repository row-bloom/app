<?php

namespace App\Http\Controllers;

use ElaborateCode\RowBloom\RowBloom;
use ElaborateCode\RowBloom\Support;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\Rule;

class RenderController
{
    public function __invoke(Request $request, RowBloom $rowBloom, Support $support): HttpResponse
    {
        $request->validate([
            'interpolatorDriver' => [
                'required',
                'string',
                Rule::in(array_keys($support->getInterpolatorDrivers())),
            ],
            'rendererDriver' => [
                'required',
                'string',
                Rule::in(array_keys($support->getRendererDrivers())),
            ],
            'template' => ['required', 'string'],
            'css' => ['required', 'string'],
            'table' => ['required', 'array', 'min:1'],
            'table.*' => ['required', 'array'],
            'options' => ['required', 'array'],
        ]);

        $rowBloom->setInterpolator($support->getInterpolatorDrivers()[$request->interpolatorDriver])
            ->setRenderer($support->getRendererDrivers()[$request->rendererDriver]);

        $rowBloom->addTable($request->table);
        $rowBloom->setTemplate($request->template);
        $rowBloom->addCss($request->css);

        foreach ($request->options as $option => $value) {
            $rowBloom->setOption($option, $value);
        }

        return Response::make(
            $rowBloom->get(),
            200,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="document.pdf"',
            ]
        );
    }
}
