@extends('layouts.app')

@section('content')
  <h3>---Aqui a página que mostra o perfil---</h3>
  <br>
  <h4>Exemplo de uma forma de aceder ao utilizador</h4>

      <div class="well">
        <h3>Eu sou o {{$user->username}}</h3>
      </div>

      <a href="/profile/{{$user->id}}/edit" class="btn btn-default">Edit my Profile</a>


@endsection