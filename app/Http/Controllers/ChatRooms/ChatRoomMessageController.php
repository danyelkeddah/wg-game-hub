<?php

namespace App\Http\Controllers\ChatRooms;

use App\Actions\Chat\SendChatMessageToRoomAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChatRoomMessageRequest;
use App\Models\ChatRoom;
use Illuminate\Http\Request;
use Redirect;

class ChatRoomMessageController extends Controller
{
    public function __invoke(
        ChatRoomMessageRequest $request,
        ChatRoom $chatRoom,
        SendChatMessageToRoomAction $sendChatMessageToRoom,
    ) {
        $sendChatMessageToRoom->execute(request: $request, chatRoom: $chatRoom);
        return Redirect::back();
    }
}
