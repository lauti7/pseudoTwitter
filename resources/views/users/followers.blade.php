@extends('layouts.app')
@section('content')
<ul class="list-unstyled">
    @foreach ($user->followers as $follower)
    <li>{{ $follower->username }}</li>
    @endforeach
</ul>
@endsection
