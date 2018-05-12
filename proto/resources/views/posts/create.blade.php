@extends('layouts.app')

@section('content')
	<h1>Create Post</h1>
	{!! Form::open(['action' => 'PostsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data' ]) !!}
	    <div class="form-group">
	    	{{ Form::label('title', 'Title') }}
	    	{{ Form::text('title', '',['class' => 'form-control', 'placeholder' => 'Title']) }}
	    </div>

	    <div class="form-group">
	    	{{ Form::label('typepost', 'Choose the type of Post') }}
			<select name="typepost" id="typepost" onchange='load_new_content()'>
				<option value="Select" selected>Select</option>
				<option value="text">Text</option>
				<option value="image">Image</option>
				<option value="link">Link</option>
			</select>
	    </div>

	    <div class="form-group">
	    	{{ Form::label('mediacategory', 'Specify the type of Media') }}
			<select name="mediacategory" id="mediacategory">
				<option value="TV Show" selected>TV Show</option>
				<option value="Movie">Movie</option>
			</select>
	    </div>

	    <div id="text" class="form-group" style="display: none;">
	    	{{ Form::label('body', 'Body') }}
	    	{{ Form::textarea('body', '',['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Body Text']) }}
	    </div>

	    <div id="link" class="form-group" style="display: none;">
	    	{{ Form::label('link', 'Put here a valid URL') }}
	    	{{ Form::text('link', '',['class' => 'form-control', 'placeholder' => 'Link']) }}
	    </div>

	    <div id="image" class="form-group" style="display: none;">
	    	{{ Form::file('image_post') }}
	    </div>

	    <div id="source" class="form-group" style="display: none;">
	    	{{ Form::label('source', 'Source') }}
	    	{{ Form::text('source', '',['class' => 'form-control', 'placeholder' => 'Source...']) }}
	    </div>

	    {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}

		{!! Form::close() !!}
@endsection


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>

<script type="text/javascript">
function load_new_content(){
     var selected_option_value=$("#typepost option:selected").val(); //get the value of the current selected option.
     if(selected_option_value=="text"){
     	document.getElementById('link').style.display = 'none';
     	document.getElementById('text').style.display = 'block';
     	document.getElementById('image').style.display = 'none';
     	document.getElementById('source').style.display = 'block';
     }
     else if(selected_option_value=="image"){
     	document.getElementById('link').style.display = 'none';
     	document.getElementById('text').style.display = 'none';
     	document.getElementById('image').style.display = 'block';
     	document.getElementById('source').style.display = 'block';
     }
     else if(selected_option_value=="link"){
     	document.getElementById('link').style.display = 'block';
     	document.getElementById('text').style.display = 'none';
     	document.getElementById('image').style.display = 'none';
     	document.getElementById('source').style.display = 'none';
     }
} 
</script>