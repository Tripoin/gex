<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReimbursementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reimbursements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('jobsheet_id')->unsigned();
            $table->integer('rmb_marketing_id')->unsigned(); //term_id
            $table->integer('rmb_document_id')->unsigned()->nullable();//doc_id
            $table->integer('rmb_unit_id')->unsigned()->nullable();//unit_id
            $table->integer('rmb_invoice_id')->unsigned()->nullable();//invoice_id->nullable();
            $table->integer('rmb_vendor_id')->unsigned()->nullable();//invoice_id->nullable();

            $table->string('rmb_name',50)->nullable();
            $table->string('rmb_price')->nullable();//price
            $table->integer('rmb_currency')->nullable();//qty
            $table->decimal('rmb_quantity')->nullable();//currency
            // $table->integer('rmb_tax')->nullable();//tax
            $table->string('rmb_total');//price

            $table->foreign('jobsheet_id')->references('id')->on('jobsheets');
            $table->foreign('rmb_marketing_id')->references('id')->on('marketings');
            $table->foreign('rmb_unit_id')->references('id')->on('master_units');
            $table->foreign('rmb_document_id')->references('id')->on('master_documents');
            $table->foreign('rmb_invoice_id')->references('id')->on('invoices');
            $table->foreign('rmb_vendor_id')->references('id')->on('master_vendors');
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
        Schema::dropIfExists('reimbursements');
    }
}
