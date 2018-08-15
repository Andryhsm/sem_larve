<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTableTicketitCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ticketit_categories', function (Blueprint $table) {
            $table->integer('type');
        });
        Schema::table('ticketit', function (Blueprint $table) {
            $table->string('email')->after('category_id');
            $table->string('name')->after('user_id');
            $table->string('type')->after('id');
            $table->integer('status_id')->nullable()->change();
            $table->integer('priority_id')->nullable()->change();
            $table->integer('user_id')->nullable()->change();
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
