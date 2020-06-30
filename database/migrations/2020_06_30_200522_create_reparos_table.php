<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReparosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Fonte.reparos', function (Blueprint $table) {
            $table->id();
            $table->string('cod_interno', 50);
            $table->string('cod_font', 50);
            $table->string('desc_problema', 100)->nullable();
            $table->string('peças', 100)->nullable();
            $table->string('status', 20)->nullable();
            
            $table->foreign('cod_font')->references('cod_font')->on('Fonte.fontes');
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
        Schema::dropIfExists('Fonte.reparos');
    }
}