<?php

use App\Models\ApiExtensions\BattInsulationCalculation;
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
        Schema::create( BattInsulationCalculation::getTableName(), function (Blueprint $table) {
            $table->id();
            $table->enum('method', BattInsulationCalculation::getAllMethods());
            $table->string('r_value_name');
            $table->decimal('square_feets_quantity', 8, 2, true);
            $table->boolean('facing');
            $table->enum('size', BattInsulationCalculation::getAllSizes());
            $table->foreignId('task_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists( BattInsulationCalculation::getTableName());
    }
};
