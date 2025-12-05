<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Message;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:read messages')->only(['index']);
        $this->middleware('can:delete messages')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = Message::paginate(10);
        return view('admin.message.index', compact('messages'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $message = Message::findOrFail($id);
        $message->delete();
        return redirect()->route('admin.messages.index')->with("admin_message",  __("language.DELETEDSUCCESSFULLY"));
    }
}