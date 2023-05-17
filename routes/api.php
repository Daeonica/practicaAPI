<?php

use App\Http\Controllers\SpoonacularController;
use App\Http\Controllers\TrelloController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

//SPOONACULAR
Route::get('/spoonacular', [SpoonacularController::class, 'index'])->name('spoonacular.index');
Route::get('/spoonacular/search', [SpoonacularController::class, 'searchRecipes'])->name('spoonacular.search');
Route::get('/spoonacular/random', [SpoonacularController::class, 'getRandomRecipe'])->name('spoonacular.random');
Route::get('/spoonacular/recipe/{id}', [SpoonacularController::class, 'getRecipe'])->name('spoonacular.recipe');

//TRELLO
Route::get('/trello', [TrelloController::class, 'getCards'])->name('trello.cards');
Route::get('/trello/create-card', [TrelloController::class, 'createCardForm'])->name('trello.createCardForm');
Route::post('/trello/create-card', [TrelloController::class, 'createCard'])->name('trello.createCard');
Route::get('/delete-card/{id}', [TrelloController::class, 'deleteCard'])->name('trello.deleteCard');
Route::get('/trello/{cardId}/edit', [TrelloController::class, 'editCardForm'])->name('trello.editCardForm');
Route::put('/trello/{cardId}/update', [TrelloController::class, 'updateCard'])->name('trello.updateCard');

//GOOGLE
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);





Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
