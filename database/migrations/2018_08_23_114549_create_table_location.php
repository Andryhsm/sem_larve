<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableLocation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location', function (Blueprint $table) {
            $table->increments('location_id');
            $table->integer('campaign_id')->index('idx_campaign_id')->unsigned();
            $table->foreign('campaign_id')
                ->references('campaign_id')->on('campaign')
                ->onDelete('set null');
            $table->string('location_name');
            $table->string('canonical_name');
            $table->integer('parent_id');
            $table->string('country_code');
            $table->string('target_type');
            $table->string('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('location');
    }
}
