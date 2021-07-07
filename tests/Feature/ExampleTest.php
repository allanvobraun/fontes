<?php

namespace Tests\Feature;

use App\Models\Fonte;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $a = Fonte::factory()->create();
        dd($a);
    }
}
