<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCampaign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaign', function (Blueprint $table) {
            $table->increments('campaign_id');
            $table->integer('user_id')->index('idx_user_id')->unsigned();
            $table->foreign('user_id')
                ->references('user_id')->on('users')
                ->onDelete('set null');
            $table->integer('location_id')->index('idx_location_id')->unsigned();
            $table->foreign('location_id')
                ->references('location_id')->on('location')
                ->onDelete('set null');
            $table->string('campaign_name');
            $table->integer('monthly_searches');
            $table->integer('convert_null_to_zero');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaign');
    }
}
