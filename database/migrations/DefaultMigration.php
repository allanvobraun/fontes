<?php

use \Illuminate\Database\Migrations\Migration;
class DefaultMigration extends Migration
{
    public function up()
    {
        DB::statement('SET SESSION sql_require_primary_key=0');

    }
}
