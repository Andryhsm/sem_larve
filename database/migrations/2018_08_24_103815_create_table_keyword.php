<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableKeyword extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
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
        Schema::dropIfExists('keyword');
    }
}
