<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRevisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revisions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('jobsheet_id')->unsigned();
            $table->integer('sender')->unsigned();
            $table->integer('receiver')->unsigned()->default(0);
            
            $table->string('note');
            $table->string('role',20)->nullable();

            $table->foreign('jobsheet_id')->references('id')->on('jobsheets');
            $table->foreign('sender')->references('id')->on('users');
            $table->foreign('receiver')->references('id')->on('users');
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
        Schema::dropIfExists('revisions');
    }
}
