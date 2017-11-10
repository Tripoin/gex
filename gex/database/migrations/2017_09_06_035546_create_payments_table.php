<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->default('');
            $table->integer('vendor_id')->unsigned();
            $table->integer('payment')->nullable();
            $table->integer('currency')->nullable();
            $table->date('date_payment');
            $table->string('note')->default('');
            $table->string('type')->default('');
            $table->string('status')->default('');
            
            $table->foreign('vendor_id')->references('id')->on('master_vendors');
            $table->timestamps();
        });

        Schema::create('payment_docs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('payment_id')->unsigned();
            $table->string('add_type')->nullable();
            $table->string('add_amount')->nullable();

            $table->foreign('payment_id')->references('id')->on('payments');
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
        Schema::dropIfExists('payable_payments');
    }
}
