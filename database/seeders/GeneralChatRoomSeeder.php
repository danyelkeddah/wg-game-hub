<?php

namespace Database\Seeders;

use App\Enums\ChatRoomType;
use App\Models\ChatRoom;
use Illuminate\Database\Seeder;

class GeneralChatRoomSeeder extends Seeder
{
    public function run()
    {
        // Create General Chatroom
        ChatRoom::create([
            'id' => 'afbf2d8b-f5a9-45d8-a8c5-14f656420db2',
            'type' => ChatRoomType::Main,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
