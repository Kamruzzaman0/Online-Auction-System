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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('seller_id')->nullable();
            $table->string('image')->nullable();
            $table->string('auth_image')->nullable();
            $table->integer('cate_id');
            $table->integer('sub_cate_id');
            $table->string('name');
            $table->text('description');
            $table->date('year');
            $table->bigInteger('mini_bid');
            $table->date('bid_end');
            $table->time('bid_time');
            $table->date('time_re');
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
        Schema::dropIfExists('products');
    }
};
