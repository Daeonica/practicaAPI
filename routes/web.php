<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SpoonacularController;
use App\Http\Controllers\TrelloController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login-google', function () {
    return Socialite::driver('google')->redirect();
});

Route::get('/google-callback', function () {
    $user = Socialite::driver('google')->user();
    $userExist = User::where('external_id', $user->id)->where('external_auth', 'google')->first();
    if ($userExist) {
        Auth::login($userExist);
    } else {
        $userNew = User::create([
            'name' => $user->name,
            'email' => $user->email,
            'avatar' => $user->avatar,
            'external_id' => $user->id,
            'external_auth' => 'google',
        ]);
        Auth::login($userNew);
    }
    return view('welcome');
});



Route::get('/login', [AuthController::class, 'showLoginForm'])->name('loginForm');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');



// Ruta para mostrar la vista de bienvenida
Route::get('/home', function () {
    return view('welcome');
})->name('welcome');
Route::post('/home', function () {
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
