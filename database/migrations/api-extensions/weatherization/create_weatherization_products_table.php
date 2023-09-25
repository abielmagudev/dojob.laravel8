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
        Schema::create('apix_weatherization_products', function (Blueprint $table) {
            $table->string('name')->unique();
            $table->decimal('unit_price', 8, 2, true)->nullable();
            $table->unsignedInteger('category_id')->nullable()->index();
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
        Schema::dropIfExists('apix_weatherization_products');
    }
};
