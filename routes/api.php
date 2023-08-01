<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/render', function (Request $request) {
    return $request->all();
});
