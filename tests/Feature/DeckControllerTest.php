<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Deck;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeckControllerTest extends TestCase
{

    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        // テストユーザーの作成
        $this->user = User::factory()->create();
        $this->actingAs($this->user, 'api');
    }

    public function testGetDecksByUserId()
    {
        // テスト用デッキの作成
        $deck = Deck::factory()->create(['user_id' => $this->user->id]);

        $response = $this->getJson("/api/decks/{$this->user->id}");

        $response->assertStatus(200)
            ->assertJsonStructure(['data' => [['id', 'user_id', 'name', 'created_at', 'updated_at']]]);
    }

    public function testStore()
    {
        $response = $this->postJson('/api/decks/store', ['user_id' => $this->user->id]);

        $response->assertStatus(201)
            ->assertJsonStructure(['data' => ['id', 'user_id', 'name', 'created_at', 'updated_at']]);

        $this->assertDatabaseHas('decks', ['user_id' => $this->user->id, 'name' => '新しいデッキ']);
    }

    public function testUpdate()
    {
        $deck = Deck::factory()->create(['user_id' => $this->user->id]);

        $updateData = [
            'userId' => $this->user->id,
            'name' => '更新されたデッキ',
            'isFavorite' => true,
            'isPublic' => false
        ];

        $response = $this->putJson("/api/decks/update/{$deck->id}", $updateData);

        $response->assertStatus(200)
            ->assertJson(['user_id' => $this->user->id, 'name' => '更新されたデッキ', 'is_favorite' => true, 'is_public' => false]);

        $this->assertDatabaseHas('decks', ['id' => $deck->id, 'name' => '更新されたデッキ']);
    }

    public function testDestroy()
    {
        $deck = Deck::factory()->create(['user_id' => $this->user->id]);

        $response = $this->deleteJson("/api/decks/{$deck->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('decks', ['id' => $deck->id]);
    }
}
