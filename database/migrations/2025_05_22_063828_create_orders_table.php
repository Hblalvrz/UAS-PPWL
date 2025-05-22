<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('laundry_id')->constrained();
            $table->decimal('weight', 8, 2);
            $table->decimal('total_price', 8, 2);
            $table->text('pickup_address');
            $table->text('delivery_address');
            $table->enum('status', ['pending', 'processing', 'completed', 'canceled'])->default('pending');
            $table->string('payment_proof')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
