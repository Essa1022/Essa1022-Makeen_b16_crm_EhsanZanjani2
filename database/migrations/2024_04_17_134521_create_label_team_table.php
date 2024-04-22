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
        Schema::create('label_team', function (Blueprint $table) {
            $table->foreignId('label_id')->constrained()->restrictOnDelete()->restrictOnUpdate();
            $table->foreignId('team_id')->constrained()->restrictOnDelete()->restrictOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('label_team');
    }
};
