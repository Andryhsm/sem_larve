<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTableStatusCategoriesPriority extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ticketit_statuses', function (Blueprint $table) {
            $table->dropColumn('name');
        });
        Schema::table('ticketit_priorities', function (Blueprint $table) {
            $table->dropColumn('name');
        });
        Schema::table('ticketit_categories', function (Blueprint $table) {
            $table->dropColumn('name');
        });
        Schema::create('ticketit_statuses_translation', function (Blueprint $table) {
            $table->increments('ticketit_statuses_translation_id');
            $table->integer('status_id');
            $table->string('name');
            $table->integer('language_id');
        });
        Schema::create('ticketit_priorities_translation', function (Blueprint $table) {
            $table->increments('ticketit_priorities_translation_id');
            $table->integer('priority_id');
            $table->string('name');
            $table->integer('language_id');
        });
        Schema::create('ticketit_categories_translation', function (Blueprint $table) {
            $table->increments('ticketit_categories_translation_id');
            $table->integer('category_id');
            $table->string('name');
            $table->integer('language_id');
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
