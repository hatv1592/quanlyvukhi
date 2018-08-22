<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameColumnDonviIdInTablePhieuxuatkho extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('phieuxuatkho', function (Blueprint $table) {
            $table->renameColumn('donvi_id', 'donvixuat_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('phieuxuatkho', function (Blueprint $table) {
            $table->renameColumn('donvixuat_id', 'donvi_id');
        });
    }
}
