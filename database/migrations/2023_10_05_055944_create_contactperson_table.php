<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contactperson', function (Blueprint $table) {
            $table->increments('contactPerson_id');
            $table->unsignedInteger('cust_id')->index();
            $table->string('contactPerson_name');
            $table->string('contactPerson_contact');
            $table->timestamps();
            $table->foreign('cust_id')->references('cust_id')->on('customer')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contactperson');
    }
};
