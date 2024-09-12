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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('last_name', 100);
            $table->string('first_name', 100);
            $table->decimal('hourly_rate', 20, 10)->nullable();
            $table->decimal('hourly_rate_charged', 20, 10)->nullable();
            $table->enum('status', ['OUVRIER', 'ETAM'])->default('OUVRIER');
            $table->integer('contract')->default(37);
            $table->decimal('monthly_salary');
            $table->decimal('basket')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
