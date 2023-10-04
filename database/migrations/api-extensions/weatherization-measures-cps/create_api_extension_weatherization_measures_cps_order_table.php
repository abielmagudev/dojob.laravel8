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
    public function up(): void
    {
        Schema::create('api_extension_weatherization_measures_cps_order', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('weatherization_product_price_id');
            $table->decimal('material_price', 8, 2, true)->nullable();
            $table->decimal('labor_price', 8, 2, true)->nullable();
            $table->unsignedInteger('order_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('api_extension_weatherization_measures_cps_order');
    }
};
