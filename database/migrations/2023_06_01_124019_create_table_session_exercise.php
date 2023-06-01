<?php

use App\Models\Exercise;
use App\Models\Session;
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
        Schema::create('exercise_session', function (Blueprint $table) {
            $table->foreignIdFor(Exercise::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Session::class)->constrained()->cascadeOnDelete();
            $table->primary(['exercise_id', 'session_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercise_session');
    }
};
