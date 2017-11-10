<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_currencies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',5);
            $table->string('display_name',30)->nullable();
            $table->decimal('priceToIDR', 10, 2); // max XX,XXX,XXX.XX
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
        Schema::dropIfExists('master_currencies');
    }
}
