@extends('layouts.app')

@section('content')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.0/components/statistic.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.0/components/icon.css" rel="stylesheet">

    <div class="container">
      <div class="row">
        <div class="col-5">
          <img src={{$user->avatar}} width="150px" height ="150px" id="profile_pic">
          <h1 id="username">{{$user->username}}</h1>
        </div>
      </div>

      <div class="row">
        <div class="col-8">
          <p id="full_name"><b>Full Name: </b>{{$user->name}} {{$user->lastname}}</p>
        </div>
      </div>

      <div class="row">
        <div class="col-8">
          <p id="age"><b>Age: </b>{{$user->datebirth}}</p>
        </div>
      </div>

      <div class="row">
        <div class="col-8">
          <p id="nationality"><b>Nationality: </b>{{$user->nationality}}</p>
        </div>
      </div>

      <div class="row">
        <div class="col-8">
          <p id="quote"><b>Favorite Quote: "</b>{{$user->quote}}<b>"</b></p>
        </div>
      </div>

      <div class="row" id="last_row">
        <div class="col-3">
          <a href="#" type="button" id="friend_request" class="btn btn-primary">Send Friend Request</a>
        </div>
      </div>
      <div class="container" id="stats_container">


<div class="ui small statistics">
  <div class="statistic">
    <div class="value">
      <i class="comment icon"></i> 5
    </div>
    <div class="label">
      Comments
    </div>
  </div>
  <span style="display:inline-block; width: 40px;"></span>
  <div class="statistic">
    <div class="value">
      22
    </div>
    <div class="label">
      Posts
    </div>
  </div>
  <span style="display:inline-block; width: 40px;"></span>
  <div class="statistic">
    <div class="value">
      <i class="hand point up outline icon"></i> {{$user->upvotes}}
    </div>
    <div class="label">
      Upvotes Received
    </div>
  </div>
  <span style="display:inline-block; width: 40px;"></span>
  <div class="statistic">
    <div class="value">
      <i class="handshake icon"></i> {{$user->downvotes}}
    </div>
    <div class="label">
      Upvotes Given
    </div>
  </div>
  <span style="display:inline-block; width: 40px;"></span>
  <div class="statistic">
    <div class="value">
      <i class="users icon"></i> 99
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
    data: {'user' : {{$user->id}}},
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