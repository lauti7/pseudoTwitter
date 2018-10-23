@extends('layouts.app')
@section('content')
<div class="col-8">
    <img style="height:150px; width:150px;"src="{{ $user->avatar }}" alt="">
    <h1>{{ $user->name }}</h1>
    <a href="{{ $user->username }}/following" class="btn btn-link">
        Siguiendo: <span class="badge badge-light">{{ count($user->follows) }}</span>
    </a>
    <a href="{{ $user->username }}/followers" class="btn btn-link ">
        Seguidores: <span class="badge badge-light">{{ count($user->followers) }}</span>
    </a>

        @if (Auth::check())
            @if (Gate::allows('dm', $user))
                <div class="form-group pt-3">
                    <form class="" action="/{{$user->username}}/dm" method="post">
                        {{ csrf_field() }}
                        <input class="form-control" placeholder="Envia un mensaje"type="text" name="message" value="">
                        <button type="submit" class="btn btn-success mt-3" name="button">Enviar</button>
                    </form>
                </div>
            @endif
            @if (Auth::user()->isFollowing($user))
                <form action="/{{$user->username}}/unfollow"  method="post">
                    {{ csrf_field() }}
                    @if(session('success'))
                    <span class="text-success">{{ session('success') }}</span>
                    @endif
                    <button class="btn btn-danger"type="submit" name="button">Dejar de seguir</button>
                </form>
            @else
                <form action="/{{$user->username}}/follow"  method="post">
                    {{ csrf_field() }}
                    @if(session('success'))
                    <span class="text-danger">{{ session('success') }}</span>
                    @endif
                    <button class="btn btn-info"type="submit" name="button">Seguir</button>
                </form>
            @endif
        @endif
    <h4 class="text-muted">{{ $user->username}}</h4>
</div>
<div class="row">
    @forelse ($user->messages as $message)
        <div class="col-6">
            <img src="{{ $message->image }}" alt="" class="img-thumbnail">
            <p class="card-text">
                {{ $message->content }}
                <span class="text-muted">by <a class="text-muted" href="/{{ $message->user->username }}">{{ $message->user->name }}</a></span>
                <a href="/messages/{{ $message->id }}">Leer mass</a><span class="text-muted">  {{ $message->created_at }}</span>
            </p>
        </div>
    @empty
        <p>No hay mensajes destacados</p>
    @endforelse
</div>
@endsection
