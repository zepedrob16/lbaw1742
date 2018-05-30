@extends('layouts.app')

@section('content')

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    
    <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
</head>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.0/components/statistic.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.0/components/icon.css" rel="stylesheet">

    <div class="container">
      <div class="row">
        <div class="col-5">
         @if( $info[0]->avatar!=null )
            <img src="/storage/{{$info[0]->avatar}}" width="150px" height ="150px" id="profile_pic">
          @else
            <p>Edit your Profile to upload your pretty face!</p>
          @endif
          <h1 id="username">{{$info[0]->username}}</h1>
        </div>
      </div>

      <div class="row">
        <div class="col-8">
          <p id="full_name"><b>Full Name: </b>{{$info[0]->name}} {{$info[0]->lastname}}</p>
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

      <div class="row" id="last_row">
        <div class="col-3">
          <a href="/profile/{{$info[0]->id}}/edit" type="button" id="edit_profile" class="btn btn-primary">Edit Profile</a>
        </div>
      </div>
      
      <div class="container" id="stats_container">


<div class="ui small statistics">
  <div class="statistic">
    <div class="value">
      <i class="comment icon"></i>{{ count($info[4]) }}
    </div>
    <div class="label">
      Comments
    </div>
  </div>
  <span style="display:inline-block; width: 40px;"></span>
  <div class="statistic">
    <div class="value">
      {{ count($info[5]) }}
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
      <i class="handshake icon"></i> {{count($info[3])}}
    </div>
    <div class="label">
      Upvotes Given
    </div>
  </div>
  <span style="display:inline-block; width: 40px;"></span>
  <div class="statistic">
    <div class="value">
      <i class="users icon"></i>{{count($info[2])}}
    </div>
    <div class="label">
      Friends
    </div>
  </div>
</div>
</div>

<!-- FRIEND REQUESTS RECEIVED -->
@if(count($info[1]) > 0)
@foreach($info[1] as $request)

   <div class="container">
      <div class = "row">
        <div class= "col" class="sender">
          @foreach($info[6] as $user)
            @if($user->id === $request->sender)
              {{$user->username}}
            @endif
          @endforeach
        </div>

        <div class= "col">
          <a href="#" type="button" class="btn btn-success" number = {{$request->sender}} >Accept</a>
        </div>

      </div>
    </div>
@endforeach
@else
        <p>No friend requests</p>
@endif

<!-- COUNT ALL FRIENDS -->
@if(count($info[2]) > 0)
  <p><a href="/friends/{{$info[0]->id}}">Show all friends.</a></p>

@else
  <p>No friends</p>
@endif


<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

<script type="text/javascript">

var requests = document.querySelectorAll('.btn-success');

var i = 0;
for (i=0; i < requests.length; i++) {

  requests[i].addEventListener('click', function(){
    handle_friend(this);
  });
}

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