<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="sub-params.css">
    <link href="{{ asset('css/sub-params.css')}}" type="text/css" rel="stylesheet">

    <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

    <title>SHOWCHAN</title>
</head>

<body>
    <div class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
        <a class="navbar-brand" href="homepage.html">SHOWCHAN -  Sign Up</a>
        <input type="text" class="form-control col-md-2" placeholder="I search for you!">
        <ul id="horizontal-style" class="navbar-nav ml-auto">
            <li class="nav-item">
            </li>
            <li class="nav-item">
                <a class="nav-link" href="signin.html">Sign In</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="signup.html">Sign Up</a>
            </li>
        </ul>
    </div>

    <form method="POST" action="{{ route('register') }}">
    {{ csrf_field() }}

    <div class="row-">
        <div class="col">
                <div class="container">
                        <div class="row">
                            <div class="col-"><h2>Username</h2></div>
                        </div>
                        <div class="row field-input">
                            <div class="col-"><input type="text" name="username" placeholder="Minimum 6 characters."></div>
                        </div>
                    </div>
                
                    <div class="container field">
                        <div class="row">
                            <div class="col-"><h2>Email</h2></div>
                        </div>
                        <div class="row field-input">
                            <div class="col-"><input type="text" name="email" placeholder="Minimum 6 characters.">
                            @if ($errors->has('email'))
      <span class="error">
          {{ $errors->first('email') }}
      </span>
    @endif
                            </div>
                        </div>
                    </div>
                
                    <div class="container field">
                        <div class="row">
                            <div class="col-"><h2>Password</h2></div>
                        </div>
                        <div class="row field-input">
                            <div class="col-"><input type="text" name="password" placeholder="Minimum 6 characters.">
                            @if ($errors->has('password'))
      <span class="error">
          {{ $errors->first('password') }}
      </span>
    @endif
    </div>
                        </div>
                    </div>
                
                    <div class="container field">
                        <div class="row">
                            <div class="col-"><h2>Confirm Password</h2></div>
                        </div>
                        <div class="row field-input">
                            <div class="col-"><input type="text" name="password_confirmation" placeholder="Minimum 6 characters."></div>
                        </div>
                    </div>
                
                    <div class="container field">
                        <div class="row">
                            <div class="col-"><input type="submit" class="btn btn-outline-success">Create Account</input></div>
                        </div>
                    </div>
        </div>
        <div class="col">
            <img id="img-responsive" src="assets/images/stock.png" alt="stock" width="50%">
        </div>
    </div>
    </form>
    


    <footer class="footer">
        <div class="container">
            <span class="text-muted">© SHOWCHAN 2018, LBAW Industries 42</span>
        </div>
    </footer>
    
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>