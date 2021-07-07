<?php

namespace Tests\Feature;

use App\Models\Fonte;
use App\Models\User;
use Tests\TestCase;

class FontesTest extends TestCase
{
    public function testCreateFonte()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $fonte = Fonte::factory()->make();
        $payload = $fonte->toArray();

        $response = $this->postJson("/api/fontes", $payload);
        $response->assertCreated();
    }
}
