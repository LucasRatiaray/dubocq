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
        Schema::create('basket_zones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('zone_id')->constrained('zones')->onDelete('cascade');
            $table->decimal('basket_zone', 10, 2);
            $table->decimal('basket_zone_charged', 10, 2)->nullable();
            $table->decimal('basket_zone_charged_daily_37H', 10, 2)->nullable();
            $table->decimal('basket_zone_charged_daily_35H', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('basket_zones');
    }
};
