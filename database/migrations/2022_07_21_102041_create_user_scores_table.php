<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('user_scores', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table
                ->foreignUuid('game_id')
                ->constrained('games')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table
                ->foreignUuid('game_lobby_id')
                ->constrained('game_lobbies')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table
                ->foreignUuid('user_id')
                ->constrained('users')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->unsignedInteger('rank');
            $table->unsignedBigInteger('score')->nullable();
            $table->unsignedBigInteger('time_played')->nullable();
            $table->timestamps();
            $table->unique(['game_lobby_id', 'user_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('game_match_scores');
    }
};
