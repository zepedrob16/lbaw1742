@extends('layouts.app')

@section('content')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.0/components/statistic.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.0/components/icon.css" rel="stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>

    @foreach($info[0] as $conversation)
    <div class="container">
    @if($conversation->read === 1)
        <div class="row">
            <div class="col">
                <div class = "row">
                    <i class="far fa-envelope-open" aria-hidden="true"></i>
                
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
                        @foreach($info[1] as $user)
                            
                            @if($user->id === $conversation->id_sender)
                                {{$user->username}}
                            @endif

                        @endforeach
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
                
                    <p class = "font-weight-bold unread" number="{{$conversation->id_conversation}}">
                        <a href="#">{{$conversation->title}}</a>
                    </p>
                
                </div>
                <div class = "row">
                    <span class="Message">
                        {{$conversation->body}}
                    </span>
                </div>
            
                <div class="row">
                    <span class = "Sender">
                        @foreach($info[1] as $user)
                            
                            @if($user->id === $conversation->id_sender)
                                {{$user->username}}
                            @endif

                        @endforeach
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

    var read_message = document.querySelectorAll('.unread');
    var i;
    for (i = 0; i < read_message.length; i++) {
        read_message[i].addEventListener('click', function() {
            handle_read(this);
        });
    }



function handle_read(read) {
  
  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
 });

    let id = read.getAttribute("number");

    console.log(id);

    var request = $.ajax({
    method: 'POST',
    url: '/read_message',
    data: {'id' : id},
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
