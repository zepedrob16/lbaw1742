@extends('layouts.app')

@section('content')
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.0/components/statistic.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.0/components/icon.css" rel="stylesheet">

      
    <div class="container">
      <div class="row">
        <div class="col-5">
         @if( $info[0]->avatar!=null )
            <img src="/storage/{{$info[0]->avatar}}" width="150px" height ="150px" id="profile_pic">
          @else
            <p>This is user doesn't have an avatar!</p>
          @endif
          <h1 id="username">My name is {{$info[0]->username}}</h1>
        </div>
      </div>

      <div class="row">
        <div class="col-8">
          <p id="full_name"><b>Full Name: </b>{{$info[0]->name}} {{$info[0]->lastname}}</p>
        </div>
      </div>

      <div class="row">
        <div class="col-8">
          <p id="age"><b>Age: </b>{{$info[0]->datebirth}}</p>
        </div>
      </div>

      <div class="row">
        <div class="col-8">
          <p id="nationality"><b>Nationality: </b>{{$info[0]->nationality}}</p>
        </div>
      </div>

      <div class="row">
        <div class="col-8">
          <p id="quote"><b>Favorite Quote: "</b>{{$info[0]->quote}}<b>"</b></p>
        </div>
      </div>

      @if(count($info[5]) == 0)
      <div class="row" id="last_row">
        <div class="col-3">
          <button type="button" id="friend_request" class="btn btn-primary" >Send Friend Request</button>
        </div>
      </div>

     
      @else
       <p> Already sent friend request </p>
      @endif

      <div class="row" id="last_row">
        <div class="col-3">
          <a href="/send_message/{{$info[0]->id}}" type="button" id="friend_request" class="btn btn-primary">Send Message</a>
        </div>
      </div>
      <div class="container" id="stats_container">


<div class="ui small statistics">
  <div class="statistic">
    <div class="value">
      <i class="comment icon"></i> {{ count($info[3]) }}
    </div>
    <div class="label">
      Comments
    </div>
  </div>
  <span style="display:inline-block; width: 40px;"></span>
  <div class="statistic">
    <div class="value">
      {{ count($info[4] )}}
    </div>
    <div class="label">
      Posts
    </div>
  </div>
  <span style="display:inline-block; width: 40px;"></span>
  <div class="statistic">
    <div class="value">
      <i class="hand point up outline icon"></i> {{$info[0]->upvotes}}
    </div>
    <div class="label">
      Upvotes Received
    </div>
  </div>
  <span style="display:inline-block; width: 40px;"></span>
  <div class="statistic">
    <div class="value">
      <i class="handshake icon"></i> {{ count($info[2]) }}
    </div>
    <div class="label">
      Upvotes Given
    </div>
  </div>
  <span style="display:inline-block; width: 40px;"></span>
  <div class="statistic">
    <div class="value">
      <i class="users icon"></i> {{ count($info[1]) }}
    </div>
    <div class="label">
      Friends
    </div>
  </div>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

<script type="text/javascript">



var friend = document.getElementById('friend_request');

friend.addEventListener('click', function() {

  handle_friend();
  location.reload(true);
});

function handle_friend() {

  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
 });

  
    var request = $.ajax({
    method: 'POST',
    url: '/new_friend',
    data: {'user' : {{$info[0]->id}}},
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