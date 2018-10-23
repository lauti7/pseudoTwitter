<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateMessageRequest;
use App\Message;
use Auth;

class MessagesController extends Controller
{
    public function create(CreateMessageRequest $request)
    {
        $image = $request->file('image');

        $message = Message::create([
            'content' => $request->content,
            'image' => $image->store('messages', 'public'),
            'user_id' => Auth::user()->id
        ]);

        return redirect('/messages/'. $message->id);
    }

    public function show(Message $message)
    {
        //$message = Message::find($id); si pongo esto diria 'Try to get a property of non-object' pero con el parametro ya no porque dice que hay error 404

        return view('message.show', [
            'message' => $message
        ]);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $messages = Message::search($query)->get();
        $messages->load('user');

        return view('message.index', ['messages' => $messages]);
    }

    public function responses(Message $message)
    {
        return $message->responses;
    }
}
