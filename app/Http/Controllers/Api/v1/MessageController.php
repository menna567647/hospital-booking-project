<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\MessageRequest;
use App\Traits\ApiResponse;
use App\Models\Message;


class MessageController extends Controller
{
    use ApiResponse;

    public function store(MessageRequest $request)
    {     
        $validated = $request->validated();

        if (auth('api')->check()) {
            
            $validated['client_id'] = auth('api')->id();
        } else {
            $validated['client_id'] = null;
        }
        Message::create($validated);
        return $this->apiSuccessMessage('your message is sent successfully', []);
    }
}
