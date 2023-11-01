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
        Schema::create('devices', function (Blueprint $table) {
            $table->id('device_id');
            $table->string('order_id');
            $table->string('brand');
            $table->string('part_No');
            $table->string('serial_No');
            $table->string('description');
            $table->string('location');
            $table->string('ms_support_startDate');
            $table->string('ms_support_endDate');
            $table->string('contract_startDate');
            $table->string('contract_endDate');
            $table->string('contract_renewalDate');
            $table->string('support_endLastDate');
            $table->string('preventive_maintennanceDate');
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
        Schema::dropIfExists('devices');
    }
};
