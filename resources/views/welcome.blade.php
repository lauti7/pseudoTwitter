@extends('layouts.app')
@section('content')
    <div class="jumbotron text-center">
        <h1>Laratter</h1>
        <nav>
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="row">
        <form action="/message/create" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div  class="form-group pt-6">
                <input class="form-control @if($errors->has('content')) is-invalid @endif" type="text" name="content" placeholder="¿Que estas pensando?" value="">
                @if ($errors->has('content'))
                    @foreach ($errors->get('content') as $error)
                        <div class="invalid-feedback">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif

            </div>

            <input type="file" class="form-control-file mb-3" name="image" value="">
        </form>
    </div>
    <div class="row">
        @forelse ($messages as $message)
            <div class="col-6">
                <img src="{{ $message->image }} " alt="" class="img-thumbnail">
                <p class="card-text">
                    {{ $message->content }}
                    <span class="text-muted">by <a class="text-muted" href="/{{ $message->user->username }}">{{ $message->user->name }}</a></span>
                    <a href="/messages/{{ $message->id }}">Leer mass</a><span>{{ $message->created_at }}</span>
                </p>
            </div>
        @empty
            <p>No hay mensajes destacados</p>
        @endforelse

        @if (count($messages))
            <div class="mt-2 mx-auto">
                {{ $messages->links('pagination::bootstrap-4') }}
            </div>
        @endif
    </div>
@endsection
