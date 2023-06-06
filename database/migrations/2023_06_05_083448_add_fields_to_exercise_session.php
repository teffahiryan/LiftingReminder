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
        Schema::table('exercise_session', function (Blueprint $table) {
            $table->integer('repetition');
            $table->integer('set');
            $table->string('weight');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('exercise_session', function (Blueprint $table) {
            $table->dropColumn('repetiton');
            $table->dropColumn('set');
            $table->dropColumn('weight');
        });
    }
};
