@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row">
            <div class="col-6">
                <h1>Interdum malesuada</h1>
            </div>
            <div class="col-6">
                <br>
                <a href="public_profile.html" id="talking_with"><p>{{$user->title}}</p></a>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-2 d-flex justify-content-center align-items-center">
                {{$user->id_sender}}
            </div>
            <div class="col-10">
            <p>
                {{$user->body}}
            </p>
            </div>
        </div>
        <div class="row">
            <div class="col-2 d-flex justify-content-center align-items-center">
                {{$user->id_recipient}}
            </div>
            <div class="col-10">
                <p>Nunc posuere, diam eu mattis varius, nulla mi mollis nibh, ut placerat felis felis quis orci. Cras bibendum est in lacinia iaculis. Proin in hendrerit leo. Nam sit amet euismod sapien, ac molestie dui. Curabitur bibendum iaculis magna. Nullam varius ligula sed turpis vulputate, et mollis velit luctus. Aliquam non arcu eget quam pretium accumsan. Aenean quis egestas lorem. Morbi dignissim quam ut neque maximus condimentum. Sed viverra ipsum vel vehicula tincidunt. Etiam at ipsum blandit, tristique diam eu, pellentesque nisl. Integer volutpat erat ut laoreet viverra. Donec ullamcorper ut nunc et euismod. Nullam gravida urna sit amet feugiat cursus.</p>
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