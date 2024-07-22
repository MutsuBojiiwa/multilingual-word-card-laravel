<?php

use App\Http\Controllers\HealthCheckController;
use App\Http\Controllers\AuthController;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeckController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\LocaleController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/health', [HealthCheckController::class, 'health']);

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
});


Route::group(['prefix' => 'decks'], function () {
    // Route::get('getAll', [DeckController::class, 'getAll']);
    Route::post('store', [DeckController::class, 'store']);
    Route::put('update/{id}', [DeckController::class, 'update']);
    Route::get('{userId}', [DeckController::class, 'getDecksByUserId']);
    Route::delete('{deckId}', [DeckController::class, 'destroy']);
});

Route::group(['prefix' => 'cards'], function () {
    // Route::get('getAll', [CardController::class, 'getAll']);
    Route::post('store', [CardController::class, 'store']);
    Route::put('details/update/{cardDetailId}', [CardController::class, 'updateCardDetail']);
    Route::get('{deckId}', [CardController::class, 'getCardDetailsByDeckId']);
    Route::delete('{cardId}', [CardController::class, 'deleteCard']);
});

Route::group(['prefix' => 'locales'], function () {
    Route::get('getAll', [LocaleController::class, 'getAll']);
    Route::get('getByIds', [LocaleController::class, 'getByIds']);
});

