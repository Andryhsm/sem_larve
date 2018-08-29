<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTableKeyword extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('keyword', function (Blueprint $table) {
            $table->string('currency');
            $table->integer('avg_monthly_searches');
            $table->double('low_range_top_of_page_bid', 20,16);
            $table->double('high_range_top_of_page_bid', 20,16);
            $table->double('ad_impression_share', 20,16);
            $table->double('organic_impression_share', 20,16);
            $table->double('organic_average_position', 20,16);
            $table->double('in_account', 20,16);
            $table->double('in_plan', 20,16);
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
