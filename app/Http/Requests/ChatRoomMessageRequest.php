<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChatRoomMessageRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'message' => ['required', 'max:1000'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
