<?php

use App\Http\Controllers\LoginController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:sanctum')->get('users', function () {
    if (Auth::check()) {
        Log::info("ミドルウェアの中");
        return User::all();
    } else {
        // 認証されていない場合の処理
        Log::info("認証されていないミドルウェアの中");
        return response()->json(['error' => 'Unauthenticated.'], 401);
    }
});

// Route::get('users', function () {
//     return User::all();
// });
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout']);
Route::get('health', [LoginController::class, 'health']);

