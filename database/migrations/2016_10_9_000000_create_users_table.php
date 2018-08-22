<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('users');
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->tinyInteger('role');
            $table->tinyInteger('status');
        });

        DB::table('users')->insert([
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123456'),
                'role' => 9,
                'status' => 1,
            ]
        );
        DB::table('users')->insert([
                'name' => 'user',
                'email' => 'user@gmail.com',
                'password' => Hash::make('123456'),
                'role' => 5,
                'status' => 1,
            ]
        );
        DB::table('users')->insert([
                'name' => 'viewer',
                'email' => 'viewer@gmail.com',
                'password' => Hash::make('123456'),
                'role' => 1,
                'status' => 1,
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
