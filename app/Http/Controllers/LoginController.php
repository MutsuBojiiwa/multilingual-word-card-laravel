<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    /**
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        Log::info("ログインの中");

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            Log::info("Authの中");

            $request->session()->regenerate();
            Log::info("セッションがリフレッシュされました。");

            $user = Auth::user();
            Log::info("ログインしたユーザー: " . $user);

            return response()->json($user);
        }

        return response()->json([], 401);
    }

    /**
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->json(true);
    }

    public function health()
    {
        return 'OKです！！';
    }
}
