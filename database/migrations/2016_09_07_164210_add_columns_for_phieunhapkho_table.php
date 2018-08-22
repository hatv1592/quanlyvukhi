<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsForPhieunhapkhoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('phieunhapkho', function (Blueprint $table) {
            $table->string('pnk_code');
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
        Schema::table('phieunhapkho', function (Blueprint $table) {
            $table->dropColumn('pnk_code');
            $table->dropTimestamps();
        });
    }
}
