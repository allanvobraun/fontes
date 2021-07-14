<?php

namespace Tests\Feature;

use App\Models\Fonte;
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

    public function testDeleteFonte()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $fonte = Fonte::factory()->hasReparos(5)->create();

        $response = $this->delete("/api/fontes/{$fonte->id}");
        $response->assertOk();
        $this->assertSoftDeleted('fontes', [
            'id' => $fonte->id
        ]);
        $this->assertSoftDeleted('reparos', [
            'fonte_id' => $fonte->id
        ]);
    }

    public function testGetFonte()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $fonte = Fonte::factory()->create();

        $response = $this->getJson("/api/fontes/{$fonte->id}");

        $response->assertOk()->assertJson([
            'data' => [
                'cod_interno' => $fonte->cod_interno,
            ]
        ]);
    }

    public function testGetFonteByCodInterno()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $fonte = Fonte::factory()->create();

        $response = $this->getJson("/api/fontes/cod/{$fonte->cod_interno}");

        $response->assertOk()->assertJson([
            'data' => [
                'id' => $fonte->id,
                'cod_interno' => $fonte->cod_interno,
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
            'id' => $response['data']['id']
        ]);
    }

    public function testEditFonte()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $fonte = Fonte::factory()->create();
        $this->assertDatabaseHas('fontes', [
            'cod_interno' => $fonte->cod_interno
        ]);

        $payload = $fonte->toArray();
        $payload['cod_interno'] = 'teste';
        $payload['cod_font'] = 'teste2';

        $response = $this->putJson("/api/fontes/{$fonte->id}", $payload);
        $response->assertOk();
        $this->assertDatabaseHas('fontes', [
            'cod_interno' => 'teste',
            'cod_font' => 'teste2',
        ]);
    }
}
