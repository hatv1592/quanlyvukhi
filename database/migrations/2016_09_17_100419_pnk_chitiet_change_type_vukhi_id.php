<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PnkChitietChangeTypeVukhiId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pnk_chitiet', function (Blueprint $table) {
            $table->integer('vukhi_id')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pnk_chitiet', function (Blueprint $table) {
            $table->float('vukhi_id')->change();
        });
    }
}
