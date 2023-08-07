<?php

use App\Http\Controllers\ReadTableContentController;
use App\Http\Controllers\RenderController;
use App\Http\Controllers\SupportController;
use Illuminate\Support\Facades\Route;

Route::get('/support', SupportController::class);

Route::post('/render', RenderController::class);

Route::post('/read-table-content', ReadTableContentController::class);
