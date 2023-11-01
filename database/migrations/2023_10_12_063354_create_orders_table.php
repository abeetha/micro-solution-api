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
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id');
            $table->string('Cust_id');
            $table->string('Customer_PO');
            $table->string('MIS_PO');
            $table->string('replacement_quote');
            $table->string('quotation');
            $table->string('SLA_reference_no');
            $table->string('contact_no');
            $table->string('Inv_No');
            $table->string('Inv_Date');
            $table->string('supplier');
            $table->string('supplier_inv_no');
            $table->string('remote');
            $table->string('onsite');
            $table->string('per_visit');
            $table->string('ext');
            $table->string('MIS');
            // $table->string('file01');
            // $table->string('file02');
            // $table->string('file03');
            $table->string('remark');
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
        Schema::dropIfExists('orders');
    }
};
