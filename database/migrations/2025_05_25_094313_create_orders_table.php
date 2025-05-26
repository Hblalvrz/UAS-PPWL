<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('order_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('laundryProvider');
            $table->unsignedBigInteger('laundryService');
            $table->dateTime('pickup_date');
            $table->enum('status', ['process', 'done']);
            $table->integer('quantity');
            $table->decimal('total_price', 10, 2);
            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('laundryProvider')->references('laundryProvider')->on('laundry_providers')->onDelete('cascade');
            $table->foreign('laundryService')->references('laundryService')->on('laundry_services')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
