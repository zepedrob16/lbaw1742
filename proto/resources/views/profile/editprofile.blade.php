@extends('layouts.app')

@section('content')
  <h3>---Aqui a página que edita o Perfil do usssser---</h3>

        <div class="well">
        <h3>O meu nome é {{$user->username}}</h3>
      </div>
@endsection