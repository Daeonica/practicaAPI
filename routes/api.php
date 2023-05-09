<?php

use App\Http\Controllers\SpoonacularController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::get('/spoonacular', [SpoonacularController::class, 'index'])->name('spoonacular.index');
Route::get('/spoonacular/search', [SpoonacularController::class, 'searchRecipes'])->name('spoonacular.search');
Route::get('/spoonacular/random', [SpoonacularController::class, 'getRandomRecipe'])->name('spoonacular.random');
Route::get('/spoonacular/recipe/{id}', [SpoonacularController::class, 'getRecipe'])->name('spoonacular.recipe');



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
