@extends('layouts.app')

@section('content')
    @foreach ($messages as $message)
        <div class="col-6">
            <img src="{{ $message->image }} " alt="" class="img-thumbnail">
            <p class="card-text">
                {{ $message->content }}
                <span class="text-muted">by <a class="text-muted" href="/{{ $message->user->username }}">{{ $message->user->name }}</a></span>
                <a href="/messages/{{ $message->id }}">Leer mass</a><span>{{ $message->created_at }}</span>
            </p>
        </div>
    @endforeach
@endsection
