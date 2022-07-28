<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('user_achievements', function (Blueprint $table) {
            $table->uuid('id');
            $table
                ->foreignUuid('game_id')
                ->constrained('games')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table
                ->foreignUuid('game_lobby_id')
                ->constrained('game_lobbies')
                ->cascadeOnDelete()
                ->cascadeOnDelete();
            $table
                ->foreignUuid('achievement_id')
                ->constrained('achievements')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table
                ->foreignUuid('user_id')
                ->constrained('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->text('additional_info')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'achievement_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_achievements');
    }
};
