<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->char('code',7)->unique()->default('');
            $table->string('name',100);
            $table->string('username')->unique()->default('');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('role')->nullable()->default('');
            $table->text('address1')->nullable();
            $table->text('address2')->nullable();
            $table->string('city')->nullable()->default('');
            $table->string('province')->nullable()->default('');
            $table->string('country')->nullable()->default('');
            $table->string('phone1',15)->nullable()->default('');
            $table->string('phone2',15)->nullable()->default('');
            $table->string('phone3',15)->nullable()->default('');
            $table->rememberToken();
            $table->timestamps();
            $table->softdeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
