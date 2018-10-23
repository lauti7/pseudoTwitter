@extends('layouts.app')
@section('content')
<ul class="list-unstyled">
    @foreach ($user->follows as $follow)
    <li>{{ $follow->username }}</li>
    @endforeach
</ul>
@endsection
