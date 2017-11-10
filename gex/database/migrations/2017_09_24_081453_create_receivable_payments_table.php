<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceivablePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receivable_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned();
            $table->integer('invoice_id')->unsigned();
            $table->integer('jobsheet_id')->unsigned();
            $table->string('no_form');
            $table->integer('currency')->default(0);
            $table->string('payment')->default('');
            $table->string('amount_rec')->default('');
            $table->string('rate')->default('');
            $table->string('pph')->default('');
            $table->string('adm_bank')->default('');
            $table->string('other')->default('');
            $table->string('remarks')->default('');
            $table->string('note')->default('');

            $table->foreign('customer_id')->references('id')->on('master_customers');
            $table->foreign('invoice_id')->references('id')->on('invoices');
            $table->foreign('jobsheet_id')->references('id')->on('jobsheets');
            
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
        Schema::dropIfExists('receivable_payments');
    }
}
