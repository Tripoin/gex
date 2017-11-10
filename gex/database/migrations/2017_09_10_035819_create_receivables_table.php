<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceivablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receivables', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('jobsheet_id')->unsigned();
            $table->integer('rec_marketing_id')->unsigned(); //term_id
            $table->integer('rec_invoice_id')->unsigned()->nullable();//invoice_id->nullable();
            $table->integer('rec_document_id')->unsigned()->nullable();//doc_id
            $table->integer('rec_unit_id')->unsigned()->nullable();//unit_id

            $table->string('rec_price')->nullable();//price
            $table->integer('rec_currency')->nullable();//qty
            $table->decimal('rec_quantity')->nullable();//currency
            $table->integer('rec_tax')->nullable();//tax
            $table->integer('rec_tax_amount')->nullable();//tax
            $table->string('rec_total');//price
            $table->integer('rec_charge_type')->nullable();//tax

            $table->foreign('jobsheet_id')->references('id')->on('jobsheets');
            $table->foreign('rec_marketing_id')->references('id')->on('marketings');
            $table->foreign('rec_invoice_id')->references('id')->on('invoices');
            $table->foreign('rec_document_id')->references('id')->on('master_documents');
            $table->foreign('rec_unit_id')->references('id')->on('master_units');
            $table->timestamps();
            // $table->char('code',8)->index()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('receivables');
    }
}
