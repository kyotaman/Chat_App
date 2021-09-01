<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;

class MessageController extends Controller
{
    public function index()
    {
        return Message::all();
    }

    public function show(Message $message)
    {
        // $message->created_at = $message->created_at->format('Y-m-d');
        return $message;
    }

    public function store(Request $request)
    {
        return Message::create($request->all());
    }

    public function update(Request $request, Message $message)
    {
        $message->update($request->all());
        return $message;
    }

    public function destroy(Message $message)
    {
        $message->delete();
        return $message;
    }
}
