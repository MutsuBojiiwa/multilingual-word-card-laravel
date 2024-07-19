<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Deck;
use App\Models\Card;
use App\Models\User;
use App\Models\LocaleMaster;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CardControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        // テストユーザーの作成
        $this->user = User::factory()->create();
        $this->actingAs($this->user, 'api');
    }

    public function testGetCardDetailsByDeckId()
    {
        // テスト用デッキとカードの作成
        $deck = Deck::factory()->create(['user_id' => $this->user->id]);
        $card = Card::factory()->withDetails(2)->create(['deck_id' => $deck->id]);

        $response = $this->getJson("/api/cards/{$deck->id}");

        $response->assertStatus(200)
            ->assertJsonStructure(['data' => ['locales', 'cards']]);
    }

    public function testStore()
    {
        $deck = Deck::factory()->create(['user_id' => $this->user->id]);
        $locale1 = LocaleMaster::factory()->create();
        $locale2 = LocaleMaster::factory()->create();

        $requestData = [
            'deck_id' => $deck->id,
            'details' => [
                ['locale_id' => $locale1->id, 'word' => 'テストワード1'],
                ['locale_id' => $locale2->id, 'word' => 'テストワード2'],
            ],
        ];

        $response = $this->postJson('/api/cards/store', $requestData);

        $response->assertStatus(201)
            ->assertJsonStructure(['data' => ['card', 'cardDetails']]);

        $this->assertDatabaseHas('cards', ['deck_id' => $deck->id]);
        $this->assertDatabaseHas('card_details', ['word' => 'テストワード1']);
        $this->assertDatabaseHas('card_details', ['word' => 'テストワード2']);
    }

    public function testDeleteCard()
    {
        $deck = Deck::factory()->create(['user_id' => $this->user->id]);
        $card = Card::factory()->create(['deck_id' => $deck->id]);

        $response = $this->deleteJson("/api/cards/{$card->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('cards', ['id' => $card->id]);
    }

    public function testUpdateCardDetail()
    {
        $locale = LocaleMaster::factory()->create();
        $deck = Deck::factory()->create(['user_id' => $this->user->id]);
        $card = Card::factory()->create(['deck_id' => $deck->id]);
        $cardDetail = \App\Models\CardDetail::factory()->create(['card_id' => $card->id, 'locale_id' => $locale->id]);

        $updateData = [
            'card_id' => $card->id,
            'locale_id' => $locale->id,
            'word' => '更新されたワード',
        ];

        $response = $this->putJson("/api/cards/details/update/{$cardDetail->id}", $updateData);

        $response->assertStatus(200)
            ->assertJson(['word' => '更新されたワード']);

        $this->assertDatabaseHas('card_details', ['id' => $cardDetail->id, 'word' => '更新されたワード']);
    }
}
