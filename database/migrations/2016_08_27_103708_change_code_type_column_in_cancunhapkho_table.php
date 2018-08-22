<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeCodeTypeColumnInCancunhapkhoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cancunhapkho', function (Blueprint $table) {
            $table->string('cancunhapkho_code', 20)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cancunhapkho', function (Blueprint $table) {
            $table->integer('cancunhapkho_code', 4)->change();
        });
    }
}
