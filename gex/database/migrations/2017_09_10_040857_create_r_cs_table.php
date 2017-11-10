<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRCsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rc', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('jobsheet_id')->unsigned();
            $table->integer('rc_document_id')->unsigned();
            $table->integer('rc_vendor_id')->unsigned();
            $table->integer('rc_unit_id')->unsigned()->nullable();

            $table->string('rc_price');//price
            $table->integer('rc_currency')->nullable();//currency when pricing input
            $table->integer('rc_payment_currency')->nullable();//currency when payable submit to manager
            $table->decimal('rc_quantity');//qty
            $table->double('rc_total',20,0)->nullable();
            $table->string('rate')->nullable();//rate
            $table->string('rc_type')->default(" ");
            $table->integer('payment_id')->unsigned()->nullable();//lunas/belum
            // $table->date('tanggal');

            $table->foreign('jobsheet_id')->references('id')->on('jobsheets');
            $table->foreign('rc_document_id')->references('id')->on('master_documents');
            $table->foreign('rc_vendor_id')->references('id')->on('master_vendors');
            $table->foreign('rc_unit_id')->references('id')->on('master_units');
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
        Schema::dropIfExists('r_cs');
    }
}
