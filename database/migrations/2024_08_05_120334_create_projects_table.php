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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('city', 100);
            $table->string('address', 255);
            $table->string('business', 100);
            $table->string('driver', 100);
            $table->integer('km');
            $table->integer('year')->nullable();
            $table->foreignId('zoneId')->constrained('zones');
            $table->foreignId('codeId')->constrained('codes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
