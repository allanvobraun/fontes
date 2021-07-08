<?php

namespace Tests\Feature;

use App\Models\Fonte;
use App\Models\Reparo;
use App\Models\User;
use App\Services\ReparoService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ReparosTest extends TestCase
{
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

    public function testGetReparos()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $fonte = Fonte::factory()->hasReparos(5)->create();

        $response = $this->getJson("/api/fontes/{$fonte->cod_interno}/reparos");

        $response->assertOk()->assertJsonCount(5, 'data');
    }

    public function testGetSumReparosByYear()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $oldYear = Carbon::createFromDate(2020);
        $currentYear = now();

        $fonte = Fonte::factory()->hasReparos(10)->create();
        Reparo::take(5)->update(['created_at' => $oldYear]);


        $years = [$oldYear->year, $currentYear->year];
        $yearsQuery = urldecode(http_build_query(['anos' => $years]));

        $response = $this->getJson("/api/fontes/reparos/valorReparosAnual?$yearsQuery");

        $response->assertOk();
    }

    public function testGetReparosValuePerWeek()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $fonte = Fonte::factory()->hasReparos(10)->create();

        $response= $this->getJson("/api/fontes/reparos/valorSemanas");
        $response->assertOk();

        $this->assertNotEquals('{}', $response['data']);
        $this->assertNotEmpty($response['data']);
    }

}
