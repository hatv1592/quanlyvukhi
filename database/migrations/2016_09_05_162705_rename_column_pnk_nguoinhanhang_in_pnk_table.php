<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameColumnPnkNguoinhanhangInPnkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('phieunhapkho', function (Blueprint $table) {
            $table->renameColumn('pxn_nguoinhanhang', 'pnk_nguoinhanhang');
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
            $table->renameColumn('pnk_nguoinhanhang', 'pxn_nguoinhanhang');
        });
    }
}
