<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterPortsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_ports', function (Blueprint $table) {
            $table->increments('id');
            $table->char('code')->index()->default('');
            $table->string('nick_name');
            $table->string('address')->nullable();
            $table->string('city')->default('');
            $table->string('province')->nullable();
            $table->string('country')->default('');
            $table->string('type',50)->default('');
            $table->string('loading',50)->default('');
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
        Schema::dropIfExists('master_ports');
    }
}
