<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="ventura.css">
    
    <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

    <title>{{ config('app.name', 'Laravel') }}</title>

  </head>
  <body>
    <div class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
        <a class="navbar-brand" href="homepage">SHOWCHAN - About Us</a>
        <input type="text" class="form-control col-md-2" placeholder="I search for you!">
        <ul id="horizontal-style" class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="profile.html">blinky</a>
            </li>
            <span style="display:inline-block; width: 15px;"></span>
            <li class="nav-item">
              <div class="dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="settings.png"  alt="icon name" height="30" width="30"> 
                </a>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="inbox.html">Inbox</a>
                    <a class="dropdown-item" href="#">Settings</a>
                    <a class="dropdown-item" href="#">Logout</a>
                    <div class="dropdown-divider"></div>
                    <a id="adminPanel" class="dropdown-item" href="admin.html">Admin Panel</a>
                  </div>
                </div>
            </li>
        </ul>
    </div>
    @yield('content')
  </body>
</html>
