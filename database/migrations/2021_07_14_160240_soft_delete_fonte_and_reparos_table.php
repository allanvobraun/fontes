<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SoftDeleteFonteAndReparosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fontes', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('reparos', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fontes', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('reparos', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
