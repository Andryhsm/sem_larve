<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableLocationsLanguageCodes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->increments('location_id');
            $table->string('location_name');
            $table->string('canonical_name');
            $table->integer('parent_id');
            $table->string('country_code');
            $table->string('target_type');
            $table->string('status');
        });
        Schema::create('languagecode', function (Blueprint $table) {
            $table->increments('language_id');
            $table->string('language_name');
            $table->string('language_code');
            $table->integer('criteron_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
