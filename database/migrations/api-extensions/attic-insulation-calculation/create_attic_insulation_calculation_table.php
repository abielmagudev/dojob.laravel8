<?php

use App\Models\ApiExtensions\AtticInsulationCalculation;
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
        Schema::create(AtticInsulationCalculation::getTableName(), function (Blueprint $table) {
            $table->id();
            $table->enum('method', AtticInsulationCalculation::getAllMethods());
            $table->string('rvalue_name');
            $table->decimal('rvalue_amount', 7, 2, true);
            $table->decimal('square_feets', 8, 2, true);
            $table->integer('bags')->default(0);
            $table->foreignId('order_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(
            AtticInsulationCalculation::getTableName()
        );
    }
};
