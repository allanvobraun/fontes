<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFontesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Fonte.fontes', function (Blueprint $table) {
            $table->string('cod_font', 50);
            $table->string('modelo', 100)->nullable();
            $table->string('fabricante', 100)->nullable();
            $table->primary('cod_font');
            // $table->foreign('empresa_id')->references('id')->on('pai.empresas');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Fonte.fontes');
    }
}