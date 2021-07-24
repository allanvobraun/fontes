<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Ramsey\Uuid\Uuid;

class AlterReparosTable extends DefaultMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        parent::up();
        Schema::table('reparos', function (Blueprint $table) {
            $table->uuid('id')->change();
        });

        $ids = DB::table('reparos')->pluck('id');
        foreach ($ids as $id) {
            DB::table('reparos')->where('id', $id)->update(['id' => Uuid::uuid4()->toString()]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reparos', function (Blueprint $table) {
            $table->id('id')->autoIncrement()->change();
        });
    }
}
