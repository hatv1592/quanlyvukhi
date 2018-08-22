<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameHevukhiCodeFieldInNhomvukhiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nhomvukhi', function (Blueprint $table) {
            $table->renameColumn('nhomvukhi_Code', 'nhomvukhi_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nhomvukhi', function (Blueprint $table) {
            $table->renameColumn('nhomvukhi_code', 'nhomvukhi_Code');
        });
    }
}
