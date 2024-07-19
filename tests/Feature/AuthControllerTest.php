<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Artisan;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function testLogin()
    {
        $user = User::factory()->create([
            'password' => Hash::make('password'),
        ]);

        Log::info("User: " . json_encode($user));

        $response = $this->postJson('/api/auth/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'user' => [
                        'id',
                        'name',
                        'email',
                        'created_at',
                        'updated_at',
                    ],
                    'authorization' => [
                        'token',
                        'type',
                    ],
                ],
            ]);
    }


    public function testRegister()
    {
        $userData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
        ];

        $response = $this->postJson('/api/auth/register', $userData);

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'message' => 'ユーザーの作成に成功しました!',
                    'user' => [
                        'name' => 'Test User',
                        'email' => 'test@example.com',
                    ],
                ],
            ]);
    }

    public function testLogout()
    {
        $user = User::factory()->create();
        $token = JWTAuth::fromUser($user);

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])
            ->postJson('/api/auth/logout');

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'message' => 'ログアウトしました。',
                ],
            ]);
    }

}
