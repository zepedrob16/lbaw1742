@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-6">
                <h1>Title</h1>
                <textarea id = "title" class="form-control" rows="1" cols="10" placeholder="Insert Title Here"></textarea>
                
            </div>
            <div class="col-6">
                <br>
                <a href="/publicprofile/{{$info[0]->id}}" id="talking_with"><p>Talking with {{$info[0]->username}}</p></a>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-12">
                <textarea id = "body" class="form-control" rows="5" cols="10"></textarea>
                <br>
                <button type="button" number = "{{$info[0]->id}}" id = "send" class="btn btn-default">Send</button>
            </div>
        </div>
        
    </div>

<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

<script type="text/javascript">

    var send_message = document.getElementById('send');

    send_message.addEventListener('click', function() {
        new_message();
    });

function new_message() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
 });

    let id_user = send_message.getAttribute("number");
    let title = document.getElementById('title').value;
    let body = document.getElementById('body').value;

    let message_info = [id_user, title, body];
    console.log(message_info);
    
    var request = $.ajax({
    method: 'POST',
    url: '/send_new_message',
    data: {'message' : message_info},
    success: function( response ){
        console.log( response );
    },
    error: function( e ) {
        console.log(e);
    }

    
});


}

</script>

@endsection