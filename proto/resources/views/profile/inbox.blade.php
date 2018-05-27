@extends('layouts.app')

@section('content')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.0/components/statistic.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.0/components/icon.css" rel="stylesheet">

    @foreach($user as $conversation)
    <div class="container">
    @if($conversation->read === 1)
        <div class="row">
            <div class="col">
                <div class = "row">
                    <i class="far fa-envelope" aria-hidden="true"></i>
                
                    <p class = "font-weight-bold read">
                        <a href="/open_inbox/{{$conversation->id_conversation}}">{{$conversation->title}}</a>
                    </p>
                
                </div>
                <div class = "row">
                    <span class="Message">
                        {{$conversation->body}}
                    </span>
                </div>
            
                <div class="row">
                    <span class = "Sender">
                        {{$conversation->id_sender}}
                    </span>
                </div>

            </div>

            <div class="col">
                <span class="STAMP">
                    {{$conversation->time_stamp}}
                </span>
            </div>
        </div>
    @endif

    @if($conversation->read === 0)
        <div class="row">
            <div class="col">
                <div class = "row">
                    <i class="far fa-envelope" aria-hidden="true"></i>
                
                    <p class = "font-weight-bold unread">
                        <a href="/open_inbox/{{$conversation->id_conversation}}">{{$conversation->title}}</a>
                    </p>
                
                </div>
                <div class = "row">
                    <span class="Message">
                        {{$conversation->body}}
                    </span>
                </div>
            
                <div class="row">
                    <span class = "Sender">
                        {{$conversation->id_sender}}
                    </span>
                </div>

            </div>

            <div class="col">
                <span class="STAMP">
                    {{$conversation->time_stamp}}
                </span>
            </div>
        </div>
    @endif

    </div>


    @endforeach

<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

<script type="text/javascript">



function handle_friend(friend) {
  
  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
 });



    var request = $.ajax({
    method: 'POST',
    url: '/accept_friend',
    data: {'user' : friend_id},
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
