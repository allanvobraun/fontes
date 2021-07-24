<?php

namespace Database\Seeders;

use App\Models\Fonte;
use App\Models\Reparo;
use Carbon\Carbon;
use Illuminate\Database\Seeder;


class FakeFontesSeeder extends Seeder
{
    public function run()
    {
        $today = Carbon::now();
        $week1 = Carbon::now()->subWeeks(1)->subDays(2);
        $week2 = Carbon::now()->subWeeks(2)->subDays(3);
        Fonte::factory()->has(Reparo::factory()->onDate($today))->create();
        Fonte::factory()->has(Reparo::factory()->onDate($week1))->create();
        Fonte::factory()->has(Reparo::factory()->onDate($week2))->create();
        for ($i = 1; $i <= 5; $i++) {
            $date = Carbon::now()->subMonths($i);
            $reparos = Reparo::factory()->onDate($date)->count(2);
            Fonte::factory()->has($reparos)->onDate($date)->count(2)->create();
        }
    }
}
