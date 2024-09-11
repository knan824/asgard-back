<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('game_platform', function (Blueprint $table) {
            $table->id();
            $table->unsignedMediumInteger('platform_id');
            $table->unsignedMediumInteger('game_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('game_platform');
    }
};
