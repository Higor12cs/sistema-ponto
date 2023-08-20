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
            $table->boolean('vacation')->after('absence')->default(false);
            $table->boolean('dismissed')->after('vacation')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attendance_employee', function (Blueprint $table) {
            $table->dropColumn('vacation');
            $table->dropColumn('dismissed');
        });
    }
};
