<?php

use App\Models\ApiExtensions\AirConditioningInstallation;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create( AirConditioningInstallation::getTableName(), function (Blueprint $table) {
            $table->id();
            $table->enum('complete', AirConditioningInstallation::getAllCompleteItems());
            $table->enum('unit_type', AirConditioningInstallation::getAllUnitTypes());
            $table->string('permission_code');
            $table->text('verifications_json_format');
            $table->text('warranties_json_format');
            $table->text('components_json_format');
            $table->foreignId('task_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists( AirConditioningInstallation::getTableName() );
    }
};
