<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobSheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobsheets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique()->default('');
            $table->integer('operation_id')->unsigned();
            $table->integer('marketing_id')->unsigned()->nullable();
            $table->integer('customer_id')->unsigned();
            $table->integer('poo_id')->unsigned(); //ports of origin
            $table->integer('pod_id')->unsigned(); //ports of destination
            $table->string('ref_no')->default('');

            $table->string('description')->nullable();
            $table->date('date')->nullable();
            $table->date('etd')->nullable();
            $table->date('eta')->nullable();
            $table->string('vessel')->nullable();
            $table->string('partymeas')->nullable();
            $table->integer('party_unit_id')->unsigned()->nullable();
            $table->text('remarks',100)->nullable();
            $table->text('instruction')->nullable();
            $table->char('freight_type',1)->nullable();
            $table->string('status')->default(''); // selesai|belum
            $table->string('step_role',20)->default(''); //

            $table->foreign('operation_id')->references('id')->on('users');
            $table->foreign('marketing_id')->references('id')->on('users');
            $table->foreign('poo_id')->references('id')->on('master_ports');
            $table->foreign('pod_id')->references('id')->on('master_ports');
            $table->foreign('party_unit_id')->references('id')->on('master_units');
            // $table->foreign('document_id')->references('id')->on('master_documents');
            $table->foreign('customer_id')->references('id')->on('master_customers');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_sheets');
    }
}
