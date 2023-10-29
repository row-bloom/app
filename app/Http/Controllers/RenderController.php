<?php

namespace App\Http\Controllers;

use RowBloom\RowBloom\RowBloom;
use RowBloom\RowBloom\Support;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\Rule;
use RowBloom\RowBloom\Config;

class RenderController
{
    public function __construct(private RowBloom $rowBloom, private Support $support) {
    }

    public function __invoke(Request $request): HttpResponse
    {
        $params = $request->validate([
            'interpolatorDriver' => [
                'required',
                'string',
                Rule::in(array_keys($this->support->getInterpolatorDrivers())),
            ],
            'rendererDriver' => [
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

        $config = (new Config)->setChromePath('C:\Program Files\Google\Chrome\Application\Chrome.exe');
        $this->rowBloom->setConfig($config);

        $this->setFromArray($params);

        return Response::make(
            $this->rowBloom->get(),
            200,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="document.pdf"',
            ]
        );
    }

    private function setFromArray(array $params): void
    {
        $this->rowBloom
            ->setInterpolator($params['interpolatorDriver'])
            ->setRenderer($params['rendererDriver']);

        $this->rowBloom->addTable($params['table']);
        $this->rowBloom->setTemplate($params['template']);
        $this->rowBloom->addCss($params['css']);

        foreach ($params['options'] as $option => $value) {
            $this->rowBloom->setOption($option, $value);
        }
    }
}
