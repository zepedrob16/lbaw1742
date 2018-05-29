@extends('layouts.app')

@section('content')
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="admin_style.css"/>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
    <title>SHOWCHAN</title>
  </head>


<div class="dashboard">
<div class="container">
<div class="table-responsive">
  <table class="table" width="10">
    <tr>
      <td align="center" class="bg-dark" scope="col">Dashboard</td> 
      <td align="center" scope="col"><a href="admin_stats.html">Statistics</a></td> 
      <td align="center" scope="col"><a href="/admin_mod/{{ Auth::user()->id }}">Moderators</a></td>
      <td align="center" scope="col"><a href="/admin/{{ Auth::user()->id }}">Users</a></td>
      <td align="center" scope="col"><a href="/admin_report/{{ Auth::user()->id }}">Reports</a></td>
    </tr>
  </table>
</div>
</div>
</div>

<div class="users_table">
<div class="col-md-10">
<table width="400" class="table table-striped table-responsive">
          <form class="navbar-form navbar-left">
        <div class="form-group">
          <input type="text" class="form-control col-md-3" placeholder="Search">
        </div>
      </form>
  <thead class="navbar-dark bg-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Username</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Age</th>
      <th scope="col">Email</th>
      <th scope="col">Membership</th>
      <th scope="col">Ban | Promote</th>
    </tr>
  </thead>

  <tbody>
    
    @foreach($info[0] as $user)
    <tr>
      <th scope="row"><i class="fas fa-user"></i></th>
      <td>{{$user->username}}</td>
      <td>{{$user->name}}</td>
      <td>{{$user->lastname}}</td>

      <td>ups</td>
      <td>{{$user->email}}</td>

      @foreach($info[1] as $admin)
        @if($admin->id_user === $user->id)
          <td>Admin</td>
        @endif
      @endforeach

      @foreach($info[2] as $mod)
        @if($mod->id_user === $user->id)
          <td>Mod</td>
        @endif
      @endforeach

      @foreach($info[3] as $member)
        @if($member->id_user === $user->id)
          <td>Member</td>
        @endif
      @endforeach
      
      <td> 
        <span class = "ban" number = {{$user->id}}>
          <i class="fas fa-ban" style = "cursor:pointer;"></i>
        </span>
        <span style="display:inline-block; width: 30px;"></span>
        @foreach($info[3] as $member)
        @if($member->id_user === $user->id)
          <span class = "promote" number = {{$user->id}}><i class="fas fa-long-arrow-alt-up" style = "cursor:pointer;" ></i></span>0
        @endif
      @endforeach
        
      </td>
    </tr>
    @endforeach


  </tbody>
</table>
<nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">Previous</span>
      </a>
    </li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
        <span class="sr-only">Next</span>
      </a>
    </li>
  </ul>
</nav>
</div>
</div>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>



<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

<script type="text/javascript">

var requests = document.querySelectorAll('.ban');
console.log(requests);
var promote_requests = document.querySelectorAll('.promote');
console.log(promote_requests);

var i;
for(i = 0; i < requests.length; i++) {
  requests[i].addEventListener('click',function(){
	   ban_request(this);
  });
}

var j;
for(j=0; j< promote_requests.length; j++){
	promote_requests[j].addEventListener('click',function(){
		promote_user(this);
	});
}

function promote_user(user){

	let id = user.getAttribute("number");

$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
 });
  
    var request = $.ajax({
    method: 'POST',
    url: '/promote',
    data: {'user' : id},
    success: function( response ){
        console.log( response );
    },
    error: function( e ) {
        console.log(e);
    }
    
});
	

}


function ban_request(user){

  let id = user.getAttribute("number");

  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
 });
  
    var request = $.ajax({
    method: 'POST',
    url: '/ban',
    data: {'user' : id},
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