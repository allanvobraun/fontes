<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Ramsey\Uuid\Uuid;


class AlterFontesTableAndRedefineKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // dropar forign de reparos
        Schema::table('reparos', function (Blueprint $table) {
            $table->dropForeign(['cod_interno']);
        });

        // dropar primaria de fontes e criar coluna uuid
        Schema::table('fontes', function (Blueprint $table) {
            $table->dropPrimary(['cod_interno']);
            $table->uuid('id')->first();
        });

        // popular uuid de fontes
        $ids = DB::table('fontes')->pluck('cod_interno');
        foreach ($ids as $id) {
            DB::table('fontes')->where('cod_interno', $id)->update(['id' => Uuid::uuid4()->toString()]);
        }

        // setar uuid de fontes como primario
        Schema::table('fontes', function (Blueprint $table) {
            $table->primary('id');
        });

        // criar coluna fonte_id em reparos
        Schema::table('reparos', function (Blueprint $table) {
            $table->uuid('fonte_id')->after('id');
        });

        // atualizar reparos com o novo id de fontes
        $subquery = '(SELECT id FROM fontes WHERE fontes.cod_interno = reparos.cod_interno)';
        $result = DB::table('reparos')
            ->update([
                'fonte_id' => DB::raw($subquery),
            ]);

        // setar fonte id em reparos como foring key
        Schema::table('reparos', function (Blueprint $table) {
            $table->foreign('fonte_id')->references('id')->on('fontes');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
