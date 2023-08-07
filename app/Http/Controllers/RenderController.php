<?php

namespace App\Http\Controllers;

use ElaborateCode\RowBloom\RowBloom;
use ElaborateCode\RowBloom\Support;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;

class RenderController
{
    public function __invoke(Request $request, RowBloom $rowBloom): HttpResponse
    {
        $request->validate([
            'interpolatorDriver' => ['required', 'string'],
            'rendererDriver' => ['required', 'string'],
            'template' => ['required', 'string'],
            'css' => ['required', 'string'],
            'table' => ['required', 'array'],
            'options' => ['required', 'array'],
        ]);

        $rowBloom->setInterpolator(app()->get(Support::class)->getInterpolatorDrivers()[$request->interpolatorDriver])
            ->setRenderer(app()->get(Support::class)->getRendererDrivers()[$request->rendererDriver]);

        $rowBloom->addTable($request->table);
        $rowBloom->setTemplate($request->template);
        $rowBloom->addCss($request->css);

        foreach ($request->options as $option => $value) {
            $rowBloom->setOption($option, $value);
        }

        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="document.pdf"',
        ];

        return Response::make($rowBloom->get(), 200, $headers);
    }
}
