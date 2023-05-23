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
        Schema::table('pontos', function (Blueprint $table) {
            $table->boolean('finalizado')->after('data')->default(false);
            $table->timestamp('finalizado_em')->after('finalizado')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pontos', function (Blueprint $table) {
            $table->dropColumn('finalizado');
            $table->dropColumn('finalizado_em');
        });
    }
};
