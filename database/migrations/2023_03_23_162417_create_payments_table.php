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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('transaction_number');
            $table->bigInteger('transaction_amount');
            $table->date('date');
            $table->string('street_address');
            $table->string('city');
            $table->integer('phone_number');
            $table->integer('buyer_id')->nullable();
            $table->integer('product_id')->nullable(); 
            $table->integer('seller_id')->nullable(); 
            $table->integer('status')->nullable(); 
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
        Schema::dropIfExists('payments');
    }
};
