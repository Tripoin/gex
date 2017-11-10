<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarketingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marketings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('jobsheet_id')->unsigned()->nullable(); //term_id
            $table->integer('term_id')->unsigned(); //term_id
            $table->integer('customer_id')->unsigned();//customer_id (bill to)

            $table->foreign('jobsheet_id')->references('id')->on('jobsheets');
            $table->foreign('term_id')->references('id')->on('master_terms');
            $table->foreign('customer_id')->references('id')->on('master_customers');
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
        Schema::dropIfExists('marketings');
    }
}
