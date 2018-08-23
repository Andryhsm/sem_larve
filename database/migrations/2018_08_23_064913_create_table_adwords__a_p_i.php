<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAdwordsAPI extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adwords_api', function (Blueprint $table) {
            $table->increments('adwords_api_id');
			$table->string('adwords_developper_token');
			$table->string('adwords_client_id');
			$table->string('adwords_client_secret');
			$table->string('adwords_client_refresh_token');
			$table->string('adwords_client_customer_id');
			$table->string('adwords_user_agent');
			$table->binary('is_default');
			$table->integer('admin_id')->index('idx_admin_id')->unsigned()->nullable();
			$table->foreign('admin_id')
				->references('admin_id')->on('admin')
				->onDelete('set null');
			$table->timestamps();
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
