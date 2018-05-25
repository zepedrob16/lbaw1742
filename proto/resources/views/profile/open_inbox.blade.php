@extends('layouts.app')

@section('content')
    <?php 
        $sender = $user[1]->where('id', $user[0]->id_sender)->first();
    ?>

    <div class="container">
        <div class="row">
            <div class="col-6">
                <h1>{{$user[0]->title}}</h1>
            </div>
            <div class="col-6">
                <br>
                <a href="/publicprofile/{{$sender->id}}" id="talking_with"><p>Talking with {{$sender->username}}</p></a>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-2 d-flex justify-content-center align-items-center">
                {{$user[0]->id_sender}}
            </div>
            <div class="col-10">
            <p>
                {{$user[0]->body}}
            </p>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <textarea class="form-control" rows="5" cols="10"></textarea>
                <br>
                <button type="button" class="btn btn-default">Send</button>
            </div>
        </div>
        
    </div>

@endsection