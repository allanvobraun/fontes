<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimestampFontesTable extends DefaultMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        parent::up();

        Schema::table('fontes', function (Blueprint $table) {
            $table->timestamps();
        });
        if (!app()->runningUnitTests()) {
            DB::table('fontes as f')
                ->join('reparos as r', 'f.id', '=', 'r.fonte_id')
                ->update([
                    'f.created_at' => DB::raw("`r`.`created_at`"),
                    'f.updated_at' => DB::raw("`r`.`created_at`")
                ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fontes', function (Blueprint $table) {
            $table->dropTimestamps();
        });
    }
}
