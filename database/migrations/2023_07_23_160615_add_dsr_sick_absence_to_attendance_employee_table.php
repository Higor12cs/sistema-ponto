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
        Schema::table('attendance_employee', function (Blueprint $table) {
            $table->boolean('dsr')->after('missed')->default(false);
            $table->boolean('sick')->after('dsr')->default(false);
            $table->boolean('absence')->after('sick')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attendance_employee', function (Blueprint $table) {
            $table->dropColumn('dsr');
            $table->dropColumn('sick');
            $table->dropColumn('absence');
        });
    }
};
