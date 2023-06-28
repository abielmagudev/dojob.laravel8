<?php

use App\Models\ApiExtensions\WallInsulationCalculation;
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
        Schema::create( WallInsulationCalculation::getTableName(), function (Blueprint $table) {
            $table->id();
            $table->enum('method', WallInsulationCalculation::getAllMethods());
            $table->string('r_value_name');
            $table->decimal('r_value_amount', 7, 2, true);
            $table->decimal('square_feets_quantity', 8, 2, true);
            $table->integer('bags_count')->default(0);
            $table->foreignId('task_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists( WallInsulationCalculation::getTableName());
    }
};
