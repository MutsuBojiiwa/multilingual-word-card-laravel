<?php

namespace Tests\Feature;

use App\Models\LocaleMaster;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class LocaleControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test getAll method.
     *
     * @return void
     */
    public function testGetAll()
    {
        $locales = LocaleMaster::factory()->count(3)->create();
        //Log::info('Created locales: ', $locales->toArray());

        $response = $this->getJson('/api/locales/getAll');
        //Log::info('Response data: ', $response->json());

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'name', 'code', 'created_at', 'updated_at']
                ]
            ])
            ->assertJsonCount(3, 'data');
    }

    /**
     * Test getByIds method.
     *
     * @return void
     */
    public function testGetByIds()
    {
        $locales = LocaleMaster::factory()->count(3)->create();
        Log::info('Created locales: ', $locales->toArray());

        $ids = $locales->pluck('id')->toArray();
        $idsAsString = implode(',', $ids);

        // Log::info('ids: ', ['ids' => $ids]);
        // Log::info('idsAsString: ', ['idsAsString' => $idsAsString]);

        $response = $this->get("/api/locales/getByIds?localeIds={$idsAsString}");
        // Log::info('Response data: ', ['data' => $response->json()]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'name', 'code', 'created_at', 'updated_at']
                ]
            ])
            ->assertJsonCount(3, 'data');
    }
}
