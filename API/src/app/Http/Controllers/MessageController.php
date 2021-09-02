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

    public function store(Request $request)
    {
        return Message::create($request->all());
    }

    public function destroy(Message $message)
    {
        $message->delete();
        return $message;
    }
}
