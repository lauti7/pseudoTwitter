<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Conversation;
use App\PrivateMessage;
use App\Notifications\UserFollowed;

class UserController extends Controller
{
    public function show($username)
    {


        $user = $this->findByUsername($username);

        $me = Auth::user();

        $conversation = Conversation::between($me, $user);

        return view('users.show', [ 'user' => $user, 'conversation' => $conversation ]);
    }

    public function follow($username, Request $r)
    {
        $user = $this->findByUsername($username);

        $me = $r->user();

        $me->follows()->attach($user);

        $user->notify(new UserFollowed($me));

        return redirect('/'.$user->username)->withSuccess('Usuario seguido!');
    }

    public function unfollow($username, Request $r)
    {
        $user = $this->findByUsername($username);

        $me = $r->user();

        $me->follows()->detach($user);

        return redirect('/'.$user->username)->withSuccess('Has dejado de seguirlo!');
    }

    public function follows($username)
    {
        $user = $this->findByUsername($username);
        return view('users.follows', ['user' => $user]);
    }

    public function followers($username)
    {
        $user = $this->findByUsername($username);
        return view('users.followers', ['user' => $user]);
    }

    public function sendPrivateMessage($username, Request $request)
    {
        $user = $this->findByUsername($username);

        $me = $request->user();

        $message = $request->input('message');

        $conversation = Conversation::between($me, $user);


        $privateMessage = PrivateMessage::create([
            'conversation_id' => $conversation->id,
            'user_id' => $me->id,
            'message' => $message
        ]);

        return redirect('/conversations/'.$conversation->id);
    }

    public function showConversation(Conversation $conversation)
    {
        $conversation->load('users', 'privateMessages');

        return view('users.chat', [ 'conversation' => $conversation, 'user' => Auth::user()]);
    }

    public function notifications(Request $r)
    {
        return $r->user()->notifications;
    }


    private function findByUsername($username)
    {
        return User::where('username', $username)->firstOrFail();
    }
}
