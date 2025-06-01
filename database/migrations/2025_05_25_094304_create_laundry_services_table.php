<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('laundry_services', function (Blueprint $table) {
            $table->bigIncrements('laundryService');
            $table->unsignedBigInteger('laundryProviders');
            $table->string('service_name');
            $table->decimal('price_per_kg', 10, 2);
            $table->timestamps();

            $table->foreign('laundryProviders')->references('laundryProvider')->on('laundry_providers')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('laundry_services');
    }
};