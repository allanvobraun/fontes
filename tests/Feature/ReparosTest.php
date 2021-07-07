<?php

namespace Tests\Feature;

use App\Models\Fonte;
use App\Models\Reparo;
use App\Models\User;
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

        $oldSum = DB::table('reparos')->selectRaw("round(sum(`valor`), 2) as valor")
            ->whereYear('created_at', '=', $oldYear)->pluck('valor')[0];

        $currentSum = DB::table('reparos')->selectRaw("round(sum(`valor`), 2) as valor")
            ->whereYear('created_at', '=', $currentYear)->pluck('valor')[0];

        $responseOld = $this->getJson("/api/fontes/reparos/valorReparosAnual?ano={$oldYear->year}");
        $responseNew = $this->getJson("/api/fontes/reparos/valorReparosAnual?ano={$currentYear->year}");

        $responseOld->assertOk()->assertJsonPath('data.0.valor', $oldSum);
        $responseNew->assertOk()->assertJsonPath('data.0.valor', $currentSum);
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
