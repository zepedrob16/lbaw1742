@extends('layouts.app')

@section('content')

{!! Form::open(['action' => ['ProfileController@update', $user->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="container">
        <div class="panel-body">
            <div class="row">
                 <div style="margin-top:80px; margin-left: 33%;" class="col-xs-4 col-sm-4 col-md-4 login-box">

                    <!-- Change Username -->
                    <div class="form-group">
                        {{ Form::label('username', 'Change Username') }}
                    {{ Form::text('username', $user->username, ['class' => 'form-control', 'placeholder' => 'Username']) }}
                    </div>

                    <!-- Change Quote -->
                    <div class="form-group">
                        {{ Form::label('quote', 'Change Quote') }}
            {{ Form::text('quote', $user->quote, ['class' => 'form-control', 'placeholder' => 'Quote']) }}
                    </div>

                    <!-- Change Avatar -->
                    <div id="image" class="form-group" placeholder="Avatar">
                        {{ Form::label('image_profile', 'Choose your avatar') }}
                        {{ Form::file('image_profile') }}
                    </div>

                    <!-- Change Nationality -->
                    <div class="form-group">
                        {{ Form::label('nationality', 'Change Nationality') }}
            {{ Form::text('nationality', $user->nationality, ['class' => 'form-control', 'placeholder' => 'Nationality']) }}
                    </div>

                    <!-- Change email -->
                    <div class="form-group">
                        {{ Form::label('email', 'Change Email') }}
            {{ Form::text('email', $user->email, ['class' => 'form-control', 'placeholder' => 'email']) }}
                    </div>

                </div>
            </div>
        </div>


        {{ Form::hidden('_method','PUT') }}
        {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
    </div> 

{!! Form::close() !!}






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