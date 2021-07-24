<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TrocaPkFonte extends DefaultMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        parent::up();
        Schema::create('fontes', function (Blueprint $table) {
            $table->string('cod_interno', 50);
            $table->string('cod_font', 50);
            $table->string('modelo', 100)->nullable();
            $table->string('fabricante', 100)->nullable();
            $table->primary('cod_interno');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fontes');

    }
}
