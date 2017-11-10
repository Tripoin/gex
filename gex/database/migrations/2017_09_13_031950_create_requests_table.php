<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('jobsheet_id')->unsigned()->nullable();
            $table->integer('payable_id')->unsigned()->nullable();
            $table->integer('rc_id')->unsigned()->nullable();
            $table->integer('bank_id')->unsigned()->nullable();
            $table->string('payment_type')->nullable(); // cash / bank
            $table->integer('user_id')->unsigned()->nullable();
            $table->date('tanggal')->nullable();
            $table->string('status')->default('');
            $table->string('type')->default('');


            $table->foreign('jobsheet_id')->references('id')->on('jobsheets');
            $table->foreign('bank_id')->references('id')->on('master_banks');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });

        \DB::statement('ALTER TABLE requests CHANGE payment_type payment_type VARCHAR(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT \'Cash or Bank\'');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requests');
    }
}
