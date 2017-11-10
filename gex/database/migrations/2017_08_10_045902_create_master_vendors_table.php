<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_vendors', function (Blueprint $table) {
            $table->increments('id');
            $table->char('code')->default('')->index();
            $table->string('name',50);
            $table->string('nick_name',30);
            $table->text('address1')->nullable();
            $table->text('address2')->nullable();
            $table->string('city',60)->nullable();
            $table->string('province',60)->nullable();
            $table->string('country',60)->nullable();
            $table->string('phone1',20)->nullable();
            $table->string('phone2',20)->nullable();
            $table->string('fax',20)->nullable();
            $table->string('zipcode',20)->nullable();
            $table->string('remark',200)->nullable();
            $table->string('type',20)->nullable();
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
        Schema::dropIfExists('master_vendors');
    }
}
