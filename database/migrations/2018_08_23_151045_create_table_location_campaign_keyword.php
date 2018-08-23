<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableLocationCampaignKeyword extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::create('location', function (Blueprint $table) {
            $table->increments('location_id');
            $table->string('location_name');
            $table->string('canonical_name');
            $table->integer('parent_id');
            $table->string('country_code');
            $table->string('target_type');
            $table->string('status');
        });*/
        
        Schema::create('campaign', function (Blueprint $table) {
            $table->increments('campaign_id');
            $table->integer('admin_id')->unsigned()->nullable();
            $table->integer('location_id')->unsigned();
            $table->string('campaign_name');
            $table->integer('monthly_searches');
            $table->integer('convert_null_to_zero')->nullable();
            $table->foreign('admin_id')
                ->references('admin_id')->on('admin')
                ->onDelete('set null');
            // $table->foreign('location_id')
            //     ->references('location_id')->on('location')
            //     ->onDelete('set null');
        });
        
        Schema::create('keyword', function (Blueprint $table) {
            $table->increments('keyword_id');
            $table->integer('campaign_id')->index('idx_campaign_id')->unsigned();
            $table->foreign('campaign_id')
                ->references('campaign_id')->on('campaign')
                ->onDelete('cascade');
            $table->string('keyword_name');
            $table->integer('search_volume');
            $table->integer('cpc');
            $table->float('competition');
            $table->text('target_monthly_search');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('location');
        Schema::dropIfExists('campaign');
        Schema::dropIfExists('keyword');
    }
}
