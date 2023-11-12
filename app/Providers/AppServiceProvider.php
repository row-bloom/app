<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use RowBloom\BrowsershotRenderer\BrowsershotRenderer;
use RowBloom\ChromePhpRenderer\ChromePhpRenderer;
use RowBloom\MpdfRenderer\MpdfRenderer;
use RowBloom\RowBloom\DataLoaders\Factory as DataLoadersFactory;
use RowBloom\RowBloom\DataLoaders\FolderDataLoader;
use RowBloom\RowBloom\DataLoaders\JsonDataLoader;
use RowBloom\RowBloom\Interpolators\Factory as InterpolatorsFactory;
use RowBloom\RowBloom\Interpolators\PhpInterpolator;
use RowBloom\RowBloom\Renderers\Factory as RenderersFactory;
use RowBloom\RowBloom\Renderers\HtmlRenderer;
use RowBloom\RowBloom\Support;
use RowBloom\SpreadsheetDataLoader\SpreadsheetDataLoader;
use RowBloom\TwigInterpolator\TwigInterpolator;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(Support::class);
        $this->app->singleton(DataLoadersFactory::class);
        $this->app->singleton(InterpolatorsFactory::class);
        $this->app->singleton(RenderersFactory::class);
    }

    public function boot(): void
    {
        /** @var support */
        $support = app()->get(Support::class);

        $support->registerDataLoaderDriver(FolderDataLoader::NAME, FolderDataLoader::class)
            ->registerDataLoaderDriver(JsonDataLoader::NAME, JsonDataLoader::class)
            ->registerInterpolatorDriver(PhpInterpolator::NAME, PhpInterpolator::class)
            ->registerRendererDriver(HtmlRenderer::NAME, HtmlRenderer::class);

        $support->registerRendererDriver(BrowsershotRenderer::NAME, BrowsershotRenderer::class)
            ->registerRendererDriver(ChromePhpRenderer::NAME, ChromePhpRenderer::class)
            ->registerRendererDriver(MpdfRenderer::NAME, MpdfRenderer::class)
            ->registerInterpolatorDriver(TwigInterpolator::NAME, TwigInterpolator::class)
            ->registerDataLoaderDriver(SpreadsheetDataLoader::NAME, SpreadsheetDataLoader::class);
    }
}
