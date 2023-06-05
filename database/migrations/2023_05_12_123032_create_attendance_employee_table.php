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
        Schema::create('attendance_employee', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attendance_id')->constrained()->restrictOnUpdate()->restrictOnDelete();
            $table->foreignId('employee_id')->constrained()->restrictOnUpdate()->restrictOnDelete();
            $table->time('clock_in')->nullable();
            $table->time('clock_out')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance_employee');
    }
};
