<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use RowBloom\RowBloom\RowBloomServiceProvider;

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
    }
}
