@extends('layouts.app')
@section('content')
    <h1>Conversación con {{ $conversation->users->except($user->id)->implode('name', ', ') }}</h1>

    @foreach($conversation->privateMessages as $message)
    <div class="card">
    	<div class="card-header">
    	{{ $message->user->name }} dijo...
    	</div>
    	<div class="card-block">
    		<p class="pt-3 pl-3">{{ $message->message }}</p>
    	</div>
    	<div class="card-footer">{{ $message->created_at }}</div>
    </div>
    	@endforeach
    
@endsection
