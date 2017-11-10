<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_documents', function (Blueprint $table) {
            $table->increments('id');
            $table->char('code')->index()->default('');
            $table->string('name');
            $table->string('display_name')->nullable();
            $table->string('type',10)->nullable();
            $table->string('remark',20)->nullable();

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
        Schema::dropIfExists('master_documents');
    }
}
