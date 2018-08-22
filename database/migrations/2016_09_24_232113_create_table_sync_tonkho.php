<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSyncTonkho extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('sync_tonkho');
        Schema::create('sync_tonkho', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('donvi_id');
            $table->integer('soluong');
            $table->integer('phancap_id');
            $table->integer('vukhi_id');
            $table->integer('nuocsanxuat_id');
            $table->integer('donvitinh_id');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->string('code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sync_tonkho');
    }
}
