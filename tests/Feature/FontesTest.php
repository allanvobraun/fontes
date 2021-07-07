<?php

namespace Tests\Feature;

use App\Models\Fonte;
use App\Models\Reparo;
use App\Models\User;
use Tests\TestCase;

class FontesTest extends TestCase
{

    public function testGetFontes()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Fonte::factory()->count(20)->create();

        $response = $this->getJson("/api/fontes?page=1");
        $response2 = $this->getJson("/api/fontes?page=2");

        $response->assertOk()->assertJsonCount(10, 'data');
        $response2->assertOk()->assertJsonCount(10, 'data');
    }

    public function testGetFonte()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $fonte = Fonte::factory()->create();

        $response = $this->getJson("/api/fontes/{$fonte->cod_interno}");

        $response->assertOk()->assertJson([
            'data' => [
                'id' => $fonte->id,
            ]
        ]);
    }

    public function testSearchFontes()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Fonte::factory()->count(10)->create();
        Fonte::factory()->create([
            'modelo' => '(batata)'
        ]);

        $response = $this->getJson("/api/fontes?page=1&search=(batata)");
        $response->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.modelo', '(batata)');

    }

    public function testCreateFonte()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $fonte = Fonte::factory()->make();
        $payload = $fonte->toArray();

        $response = $this->postJson("/api/fontes", $payload);
        $response->assertCreated();
        $this->assertDatabaseHas('fontes', [
            'id' => $response['id']
        ]);
    }

    public function testCreateReparo()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $fonte = Fonte::factory()->create();
        $reparo = Reparo::factory()->make();
        $payload = $reparo->toArray();

        $response = $this->postJson("/api/fontes/{$fonte->cod_interno}/reparos", $payload);
        $response->assertCreated();
        $this->assertDatabaseHas('reparos', [
            'id' => $response['id']
        ]);
    }

}
