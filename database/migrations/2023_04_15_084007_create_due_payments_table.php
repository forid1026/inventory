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
        Schema::create('due_payments', function (Blueprint $table) {
            $table->id();
            $table->integer('invoice_no')->nullable();
            $table->string('customer_name')->nullable();
            $table->date('date')->nullable();
            $table->double('payment_amount')->nullable();
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
        Schema::dropIfExists('due_payments');
    }
};
