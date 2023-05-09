<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SpoonacularController;

Route::get('/', function () {
    return view('welcome');
});
