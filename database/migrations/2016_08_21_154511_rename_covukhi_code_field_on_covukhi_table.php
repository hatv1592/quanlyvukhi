<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameCovukhiCodeFieldOnCovukhiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('covukhi', function (Blueprint $table) {
            $table->renameColumn('Covukhi_code', 'covukhi_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('covukhi', function (Blueprint $table) {
            $table->renameColumn('covukhi_code', 'Covukhi_code');
        });
    }
}
