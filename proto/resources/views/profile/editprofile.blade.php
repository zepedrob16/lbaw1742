@extends('layouts.app')

@section('content')
<!DOCTYPE html>

<form action="/action_page.php">
    <div class="container">
        <div class="panel-body">
            <div class="row">
                 <div style="margin-top:80px; margin-left: 33%;" class="col-xs-4 col-sm-4 col-md-4 login-box">
                    <label for="uname"><b>Change Username</b></label><br>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                            <input class="form-control" type="password" placeholder="New Username">
                        </div>
                    </div>

                    <label for="uname"><b>New Quote</b></label><br>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><span class="glyphicon glyphicon-font"></span></div>
                            <input class="form-control" type="password" placeholder="New Quote">
                        </div>
                    </div>

                    <label for="uname"><b>Change Avatar</b></label><br>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><span class="glyphicon glyphicon-camera"></span></div>
                            <input class="form-control" type="password" placeholder="New Avatar">
                        </div>
                    </div>

                    <label for="uname"><b>Change Nationality</b></label><br>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><span class="glyphicon glyphicon-flag"></span></div>
                            <input class="form-control" type="password" placeholder="New Nationality">
                        </div>
                    </div>

                    <label for="uname"><b>Change E-mail</b></label><br>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><span class="glyphicon glyphicon-log-in"></span></div>
                            <input class="form-control" type="password" placeholder="New E-mail">
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <div class="panel-footer">
            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-4"></div>
                <div class="col-xs-4 col-sm-4 col-md-4">
                    <button class="btn icon-btn-save btn-success" type="submit">
                    <span class="btn-save-label"><i class="glyphicon glyphicon-floppy-disk"></i></span>Save</button>
                </div>
            </div>
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


</html>
@endsection