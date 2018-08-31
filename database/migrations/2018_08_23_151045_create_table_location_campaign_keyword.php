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
            $table->integer('country_id')->unsigned()->nullable();
            $table->integer('province_id')->unsigned()->nullable();
            $table->integer('area_id')->unsigned()->nullable();
            $table->string('campaign_name');
            $table->integer('monthly_searches');
            $table->integer('convert_null_to_zero')->nullable();
            $table->foreign('admin_id')
                ->references('admin_id')->on('admin')
                ->onDelete('set null');
            $table->integer('language_id')->unsigned();
            $table->timestamp('added_on');
        });
        
        Schema::create('keyword', function (Blueprint $table) {
            $table->increments('keyword_id');
            $table->integer('campaign_id')->index('idx_campaign_id')->unsigned();
            $table->foreign('campaign_id')
                ->references('campaign_id')->on('campaign')
                ->onDelete('cascade');
            $table->string('keyword_name');
            $table->double('competition',20,16)->nullable();
            $table->integer('cpc')->nullable();
            $table->string('currency')->nullable();
            $table->integer('avg_monthly_searches')->nullable();
            $table->double('low_range_top_of_page_bid', 20,16)->nullable();
            $table->double('high_range_top_of_page_bid', 20,16)->nullable();
            $table->double('ad_impression_share', 20,16)->nullable();
            $table->double('organic_impression_share', 20,16)->nullable();
            $table->double('organic_average_position', 20,16)->nullable();
            $table->double('in_account', 20,16)->nullable();
            $table->double('in_plan', 20,16)->nullable();
            $table->text('target_monthly_search')->nullable();
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
