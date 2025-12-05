<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\MessageRequest;
use App\Models\Message;


class ClientMessageController extends Controller
{

    public function store(MessageRequest $request)
    {
        $validated = $request->validated();
        if (auth()->guard('client')->check()) {
            $validated['client_id'] = auth()->guard('client')->id();
        } else {
            $validated['client_id'] = null;
        }
        Message::create($validated);    
        return redirect()->route('website.page')->with('client_message','your message is sent successfully');
    }
}