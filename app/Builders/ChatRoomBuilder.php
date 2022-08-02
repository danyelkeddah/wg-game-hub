<?php

namespace App\Builders;

use App\Enums\ChatRoomType;
use Illuminate\Database\Eloquent\Builder;

class ChatRoomBuilder extends Builder
{
    public function mainChannel(): static
    {
        return $this->where('type', ChatRoomType::Main);
    }
}
