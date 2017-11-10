<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payables', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned(); //term_id
            $table->integer('jobsheet_id')->unsigned();
            $table->integer('document_id')->unsigned()->nullable();//doc_id
            $table->integer('vendor_id')->unsigned();//vendor_id (bill to)
            $table->integer('unit_id')->unsigned()->nullable();//unit_id
            
            $table->string('price')->nullable();//price
            $table->integer('currency')->nullable();//currency when pricing input
            $table->integer('payment_currency')->nullable();//currency when payable submit to manager
            $table->decimal('quantity')->nullable();//qty
            $table->string('rate')->nullable()->default('');//rate
            $table->double('total', 20,0)->nullable();
            // $table->string('status')->default('');
            
            // request_id
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('jobsheet_id')->references('id')->on('jobsheets');
            $table->foreign('document_id')->references('id')->on('master_documents');
            $table->foreign('vendor_id')->references('id')->on('master_vendors');
            $table->foreign('unit_id')->references('id')->on('master_units');
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
        Schema::dropIfExists('payables');
    }
}
