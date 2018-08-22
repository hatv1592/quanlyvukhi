<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('roles');
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('display_name');
            $table->string('description');
            $table->timestamps();
        });

        DB::table('roles')->insert([
                [
                    'id' => 1,
                    'name' => 'viewer',
                    'display_name' => 'Quyền xem',
                    'description' => '',
                ],
                [
                    'id' => 5,
                    'name' => 'user',
                    'display_name' => 'Thành viên',
                    'description' => '',
                ],
                [
                    'id' => 9,
                    'name' => 'super admin',
                    'display_name' => 'Quyền full',
                    'description' => '',
                ]]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('roles');
    }
}
