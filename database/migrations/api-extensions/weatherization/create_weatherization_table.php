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
        Schema::create('apix_weatherization', function (Blueprint $table) {
            $table->string('product')->index();
            $table->unsignedSmallInteger('quantity');
            $table->unsignedInteger('order_id')->index();
            $table->dateTime('created_at')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apix_weatherization');
    }
};
