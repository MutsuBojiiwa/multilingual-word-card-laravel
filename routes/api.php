<?php

use App\Http\Controllers\HealthCheckController;
use App\Http\Controllers\AuthController;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeckController;
use App\Http\Controllers\CardController;


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
    Route::put('update/{id}', [DeckController::class, 'update']);
    Route::get('{userId}', [DeckController::class, 'getDecksByUserId']);
});

Route::group(['prefix' => 'cards'], function () {
    // Route::get('getAll', [CardController::class, 'getAll']);
    Route::post('store', [CardController::class, 'store']);
    Route::get('{userId}', [CardController::class, 'getCardDetailsByDeckId']);
});



// Route::controller(DeckController::class)->group(function () {
//     Route::get('/decks', 'index');
//     Route::get('/decks/{userId}', 'getDecksByUserId');
// });


// Route::apiResource('decks', DeckController::class);


// Route::middleware('auth:api')->get('users', function () {
//     $users = User::all();
//     return response()->json([
//         'data' => $users
//     ]);

// });

// Route::get('/check-jwt-secret', function () {
//     return response()->json(['jwt_secret' => env('JWT_SECRET')]);
// });

// Route::get('/check-environment', function () {
//     return response()->json([
//         'environment' => $_ENV,
//     ]);
// });
