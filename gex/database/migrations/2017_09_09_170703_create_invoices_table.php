<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->char('code')->unique()->default('');
            $table->integer('customer_id')->unsigned()->index();
            $table->integer('jobsheet_id')->unsigned()->index();
            $table->integer('bank_id')->unsigned()->index();
            $table->date('tanggal');
            $table->char('status',1)->default('0');
            $table->char('approval',1)->default('0');
            $table->char('type')->default('');
            $table->char('efaktur')->default('');
            $table->char('due_date')->default('');
            $table->char('receipt_date')->default('');
            $table->text('reason')->nullable();
            $table->date('date_request')->nullable();
            
            $table->foreign('jobsheet_id')->references('id')->on('jobsheets');
            $table->foreign('customer_id')->references('id')->on('master_customers');
            $table->foreign('bank_id')->references('id')->on('master_banks');

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
        Schema::dropIfExists('invoices');
    }
}
