@extends('layouts.app')
@section('content')
    <img class="img-thumbnail" src="{{ $message->image }} " alt="">
    <p class="card-text">{{ $message->content }}<small class="text-muted"> {{  $message->created_at }}</small></p>
    <span class="text-muted">by <a class="text-muted" href="/{{ $message->user->username }}">{{ $message->user->name }}</a></span>

    <responses :message="{{ $message->id }}" :userlink={{ $message->user->username }}></responses>
@endsection
