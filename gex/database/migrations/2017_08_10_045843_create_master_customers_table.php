<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_customers', function (Blueprint $table) {
            $table->increments('id');
            $table->char('code')->default('')->index();
            $table->string('name',50)->default('');
            $table->string('nick_name',30)->default('')->unique();
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('country')->nullable();
            $table->string('phone1', 20)->nullable();
            $table->string('phone2', 20)->nullable();
            $table->string('fax',30)->nullable();
            $table->string('zipcode',10)->nullable();
            $table->string('type',30)->default('')->nullable();
            // $table->string('agent',30)->default('')->nullable();
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
        Schema::dropIfExists('master_customers');
    }
}
