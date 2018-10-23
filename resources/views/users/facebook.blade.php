@extends('layouts.app')
@section('content')
<form class="" action="/auth/facebook/register" method="post">
    {{ csrf_field() }}
    <div class="card">
        <div class="card-block">
            <img class="img-thumbnail" src="{{ $user->avatar }}" alt="">
        </div>
        <div class="card-block">
            <div class="form-group">
                <label for="name" class="form-control-name">Nombre</label>
                <input class="form-control" type="text" name="name" value="{{ $user->name }}" readonly>
            </div>

            <div class="form-group">
                <label for="email" class="form-control-name">Email</label>
                <input class="form-control" type="text" name="email" value="{{ $user->email }}" readonly>
            </div>

            <div class="form-group">
                <label for="username" class="form-control-name">Nombre de usuario</label>
                <input class="form-control" type="text" name="username" value="" >
            </div>

        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary" name="button">Registrarse</button>
        </div>
    </div>
</form>
@endsection
