<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TrocaFkReparo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('reparos');
        Schema::create('reparos', function (Blueprint $table) {
            $table->id();
            $table->string('cod_interno', 50);
            $table->string('desc_problema', 100)->nullable();
            $table->string('peças', 100)->nullable();
            $table->float('valor');
            $table->string('status', 20)->nullable();
            
            $table->foreign('cod_interno')->references('cod_interno')->on('fontes');
            $table->timestamps();
        });

        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reparos');

    }
}
