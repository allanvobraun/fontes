<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewReparosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reparos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('fonte_id');
            $table->foreign('fonte_id')->references('id')->on('fontes');
            $table->string('desc_problema', 100)->nullable();
            $table->string('peças', 100)->nullable();
            $table->float('valor')->default(0);
            $table->string('status', 20)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('new_fontes');
    }
}
