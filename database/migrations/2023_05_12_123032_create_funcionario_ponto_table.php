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
        Schema::create('funcionario_ponto', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ponto_id')->constrained()->restrictOnUpdate()->restrictOnDelete();
            $table->foreignId('funcionario_id')->constrained()->restrictOnUpdate()->restrictOnDelete();
            $table->time('entrada1')->nullable();
            $table->time('saida1')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('funcionario_ponto');
    }
};
