<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('laundry_providers', function (Blueprint $table) {
            $table->bigIncrements('laundryProvider');
            $table->string('laundry_name');
            $table->text('address');
            $table->text('description');
            $table->string('phone');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('laundry_providers');
    }
};
