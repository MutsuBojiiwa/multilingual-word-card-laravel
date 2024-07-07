<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'logout']]);
    }

    public function login(Request $request)
    {
        Log::info("ログインメソッドの中");
        Log::info('$request=' . json_encode($request->all()));

        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');
        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json([
                'message' => '認証に失敗しました。',
            ], 401);
        }

        $user = JWTAuth::user();
        Log::info('$credentials=' . json_encode($credentials));
        Log::info('$token=' . $token);
        Log::info('$user=' . json_encode($user));

        return response()->json([
            'data' => [
                'user' => $user,
                'authorization' => [
                    'token' => $token,
                    'type' => 'bearer',
                ]
            ]
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ], [
            'email.unique' => 'このメールアドレスはすでに使用されています',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return response()->json([
            'data' => [
                'message' => 'ユーザーの作成に成功しました!',
                'user' => $user
            ]
        ]);
    }

    public function logout()
    {
        if(JWTAuth::getToken()){
            JWTAuth::invalidate(JWTAuth::getToken());
        }
        return response()->json([
            'data' => [
                'message' => 'ログアウトしました。',
            ]
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'user' => JWTAuth::user(),
            'authorization' => [
                'token' => JWTAuth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }
}
