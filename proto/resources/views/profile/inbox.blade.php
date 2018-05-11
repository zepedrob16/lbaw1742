@extends('layouts.app')

@section('content')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.0/components/statistic.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.0/components/icon.css" rel="stylesheet">

    @foreach($user as $conversation)
    <div class="container">

        <div class="row">
            <div class="col">
                <div class = "row">
                    <i class="far fa-envelope" id="unopenMessage" aria-hidden="true"></i>
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
                    28/02/2017
                </span>
            </div>
        </div>
    
    </div>
    @endforeach

    <footer class="footer"> <div class="container"> <span class="text-muted">© SHOWCHAN 2018, LBAW Industries 42</span> </div> </footer>
    
@endsection
