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
        Schema::create('api_extension_weatherization_products_prices_cps', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique('weatherization_cps_name');
            $table->unsignedTinyInteger('item_price_id')->unique('weatherization_cps_item_price_id');
            $table->decimal('material_price', 8, 2, true)->nullable();
            $table->decimal('labor_price', 8, 2, true)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('api_extension_weatherization_products_prices_cps');
    }
};
