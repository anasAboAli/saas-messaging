<?php

namespace App\Http\Controllers;

abstract class Controller
{
    //
}


use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::where('tenant_id', tenant('id'))->get();
        return view('messages.index', compact('messages'));
    }

    public function send(Request $request)
    {
        Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'content' => $request->content,
            'tenant_id' => tenant('id')
        ]);

        return back();
    }
}