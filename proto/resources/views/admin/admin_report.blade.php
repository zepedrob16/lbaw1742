@extends('layouts.app')

@section('content')


  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->

    <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">


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
      <th scope="col">Report Title</th>
      <th scope="col">Type</th>
      <th scope="col">Date</th>
      <th scope="col">Solved</th>
    </tr>
  </thead>

  <tbody>

    @foreach($info[1] as $report)
    <tr>
      <th scope="row"><i class="fas fa-flag"></i></th>
      <td>{{$report->title}}</td>
      <td><a href="/posts/{{$report->postid}}">{{$report->type}}</a></td>
      
     

      <td>{{$report->time_stamp}}</td>
      <td>
          <span class="fixed" number = {{$report->id}}> 
          <i class="fas fa-check" style = "cursor:pointer;"></i></td>
        </span>
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




var reports = document.querySelectorAll('.fixed');

var i;

for(i = 0; i < reports.length; i++) {
  reports[i].addEventListener('click',function(){
     solve_report(this);
  });
}

function solve_report(report){

  let id = report.getAttribute("number");

  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
 });
  
    var request = $.ajax({
    method: 'POST',
    url: '/solve_report',
    data: {'report' : id},
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