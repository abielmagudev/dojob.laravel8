<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('api_extensions', function (Blueprint $table) {
            $table->id();
            $table->string('model_class');
            $table->string('controller_class');
            $table->string('tags_csv_format');
            $table->decimal('price', 8, 2, true)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('api_extensions');
    }
};
