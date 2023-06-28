<?php

use App\Models\ApiExtensions\MinisplitInstallation;
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
        Schema::create( MinisplitInstallation::getTableName(), function (Blueprint $table) {
            $table->id();
            $table->string('application_permission');
            $table->text('pieces_json_format');
            $table->foreignId('task_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists( MinisplitInstallation::getTableName());
    }
};
