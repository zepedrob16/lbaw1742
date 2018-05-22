@extends('layouts.app')

@section('content')
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

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
      <td align="center" scope="col"><a href="admin_mod.html">Moderators</a></td>
      <td align="center" scope="col"><a href="admin.html">Users</a></td>
      <td align="center" scope="col"><a href="admin_reports.html">Reports</a></td>
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
    <tr>
      <th scope="row"><img src="assets/open-iconic/svg/person.svg" alt="icon name" height="13" width="13"></th>
      <td>@mdo</td>
      <td>Mark</td>
      <td>Otto</td>
      <td>16</td>
      <td>email@feup.pt</td>
      <td>Member</td>
      <td> 
        <i id = "este" class="fas fa-ban"></i>
        <span style="display:inline-block; width: 30px;"></span>
        <img src="assets/open-iconic/svg/arrow-thick-top.svg" alt="icon name" height="13" width="13">
      </td>
    </tr>
    <tr>
      <th scope="row"><img src="assets/open-iconic/svg/person.svg" alt="icon name" height="13" width="13"></th>
      <td>@fat</td>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>20</td>
      <td>email@feup.pt</td>
      <td>Member</td>
      <td> 
        <img src="assets/open-iconic/svg/ban.svg" alt="icon name" height="13" width="13"> 
        <span style="display:inline-block; width: 30px;"></span>
        <img src="assets/open-iconic/svg/arrow-thick-top.svg" alt="icon name" height="13" width="13">
      </td>
    </tr>
    <tr>
      <th scope="row"><img src="assets/open-iconic/svg/person.svg" alt="icon name" height="13" width="13"></th>
      <td>@twitter</td>
      <td>Larry</td>
      <td>the Bird</td> 
      <td>21</td>
      <td>email@feup.pt</td>
      <td>Admin</td>
      <td> 
        <img src="assets/open-iconic/svg/ban.svg" alt="icon name" height="13" width="13"> 
        <span style="display:inline-block; width: 30px;"></span>
        <img src="assets/open-iconic/svg/arrow-thick-top.svg" alt="icon name" height="13" width="13">
      </td>
    </tr>
    <tr>
      <th scope="row"><img src="assets/open-iconic/svg/person.svg" alt="icon name" height="13" width="13"></th>
      <td>@askmgsd</td>
      <td>Louis</td>
      <td>Striker</td> 
      <td>19</td>
      <td>email@feup.pt</td>
      <td>Member</td>
      <td> 
        <img src="assets/open-iconic/svg/ban.svg" alt="icon name" height="13" width="13"> 
        <span style="display:inline-block; width: 30px;"></span>
        <img src="assets/open-iconic/svg/arrow-thick-top.svg" alt="icon name" height="13" width="13">
      </td>
    </tr>
    <tr>
      <th scope="row"><img src="assets/open-iconic/svg/person.svg" alt="icon name" height="13" width="13"></th>
      <td>@twislt</td>
      <td>Sue</td>
      <td>Morgan</td> 
      <td>39</td>
      <td>email@feup.pt</td>
      <td>Member</td>
      <td> 
        <img src="assets/open-iconic/svg/ban.svg" alt="icon name" height="13" width="13"> 
        <span style="display:inline-block; width: 30px;"></span>
        <img src="assets/open-iconic/svg/arrow-thick-top.svg" alt="icon name" height="13" width="13">
      </td>
    </tr>
    <tr>
      <th scope="row"><img src="assets/open-iconic/svg/person.svg" alt="icon name" height="13" width="13"></th>
      <td id="aquele">@lagiu</td>
      <td>Peter</td>
      <td>Parker</td> 
      <td>12</td>
      <td>email@feup.pt</td>
      <td>Member</td>
      <td> 
        <img src="assets/open-iconic/svg/ban.svg" alt="icon name" height="13" width="13"> 
        <span style="display:inline-block; width: 30px;"></span>
        <img src="assets/open-iconic/svg/arrow-thick-top.svg" alt="icon name" height="13" width="13">
      </td>
    </tr>
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


<footer class="footer">
        <div class="container">
            <span class="text-muted">© SHOWCHAN 2018, LBAW Industries 42</span>
        </div>
    </footer> 

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>



<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

<script type="text/javascript">

var requests = document.getElementById('aquele');
console.log(requests);
requests.addEventListener('click',function(){
	ban_request();
});

function ban_request(){


console.log(requests);

	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
 });

  
    var request = $.ajax({
    method: 'POST',
    url: '/ban',
    data: {'user' : 21},
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