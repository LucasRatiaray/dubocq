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
        Schema::create('time_trackings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects');
            $table->foreignId('employee_id')->constrained('employees');
            $table->decimal('hours', 10, 2)->nullable();
            $table->decimal('night_hours', 10, 2)->nullable();
            $table->enum('absenceType', ['ABS', 'FERIE', 'RTT'])->nullable();
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('time_trackings');
    }
};
