<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use RowBloom\BrowsershotRenderer\BrowsershotRenderer;
use RowBloom\ChromePhpRenderer\ChromePhpRenderer;
use RowBloom\MpdfRenderer\MpdfRenderer;
use RowBloom\RowBloom\RowBloomServiceProvider;
use RowBloom\RowBloom\Support;
use RowBloom\TwigInterpolator\TwigInterpolator;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        app()->singleton(RowBloomServiceProvider::class);
        app()->get(RowBloomServiceProvider::class)->register();
    }

    public function boot(): void
    {
        app()->get(RowBloomServiceProvider::class)->boot();

        /** @var support */
        $support = app()->get(Support::class);

        $support->registerRendererDriver(BrowsershotRenderer::NAME, BrowsershotRenderer::class)
            ->registerRendererDriver(ChromePhpRenderer::NAME, ChromePhpRenderer::class)
            ->registerRendererDriver(MpdfRenderer::NAME, MpdfRenderer::class);

        $support->registerInterpolatorDriver(TwigInterpolator::NAME, TwigInterpolator::class);
    }
}
