<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('laundry_services', function (Blueprint $table) {
            $table->id(); // 'id' auto‐increment (jika sebelumnya pakai 'laundryService' ubah sesuai)
            $table->string('service_name');
            $table->decimal('price_per_kg', 10, 2);
            $table->string('image_path')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('laundry_services');
    }
};
