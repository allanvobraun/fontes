<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make(config('app.adm_password')),
            ],
            [
                'name' => 'alcido',
                'email' => 'alcido@admin.com',
                'password' => Hash::make(config('user.adm_password')),
            ]
        ]);

    }
}
