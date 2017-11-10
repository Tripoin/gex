<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_documents', function (Blueprint $table) {
            //
            $table->increments('id');
            $table->integer('invoice_id')->unsigned();
            $table->string('name');
            $table->string('no_ref')->default('');

            $table->foreign('invoice_id')->references('id')->on('invoices');
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
        Schema::dropIfExists('invoice_documents');
    }
}
