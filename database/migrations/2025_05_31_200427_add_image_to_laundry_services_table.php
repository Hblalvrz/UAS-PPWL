<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('laundry_services', function (Blueprint $table) {
        $table->string('image_path')->nullable()->after('price_per_kg');
        });
    }
    public function down()
    {
        Schema::table('laundry_services', function (Blueprint $table) {
        $table->dropColumn('image_path');
        });
    }

};
