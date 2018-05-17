@extends('layouts.app')

@section('content')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.0/components/statistic.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.0/components/icon.css" rel="stylesheet">

    <div class="container">
      <div class="row">
        <div class="col-5">
          <img src={{$info[0]->avatar}} width="150px" height ="150px" id="profile_pic">
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

      <div class="row" id="last_row">
        <div class="col-3">
          <a href="/profile/{{$info[0]->id}}/edit" type="button" id="edit_profile" class="btn btn-primary">Edit Profile</a>
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
      <i class="hand point up outline icon"></i> {{$info[0]->upvotes}}
    </div>
    <div class="label">
      Upvotes Received
    </div>
  </div>
  <span style="display:inline-block; width: 40px;"></span>
  <div class="statistic">
    <div class="value">
      <i class="handshake icon"></i> {{$info[0]->downvotes}}
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

<!-- FRIEND REQUESTS RECEIVED -->
@if(count($info[1]) > 0)
@foreach($info[1] as $request)

   <div class="container">
      <div class = "row">
        <div class= "col">
          {{$request->sender}}
        </div>

        <div class= "col">
          <a href="#" type="button" class="btn btn-success">Accept</a>
        </div>

      </div>
    </div>
@endforeach
@else
        <p>No friend requests</p>
@endif

<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

<script type="text/javascript">

var requests = document.querySelectorAll('.btn-success');

var i;
for (i=0; i < requests.length; i++) {

  requests[i].addEventListener('click', function() {
    handle_friend();
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
    url: '/accept_friend',
    data: {'user' : {{$info[1][0]->id}}},
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