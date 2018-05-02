@extends('layouts.app')

<?php
session_start();
$content = $_SESSION['content'];
$id = $_SESSION['id'];
?>

@section('content')
	<h1>Edit Post</h1>
	{!! Form::open(['action' => ['PostsController@update', $post->postnumber], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
	    <div class="form-group">
	    	{{ Form::label('title', 'Title') }}
	    	{{ Form::text('title', $post->title, ['class' => 'form-control', 'placeholder' => 'Title']) }}
	    </div>
			@if($post->type === "text")
			    <div class="form-group">
			    	{{ Form::label('body', 'Body') }}
			    	{{ Form::textarea('body', $content,['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Body Text']) }}
			    </div>		
			    <div id="source" class="form-group">
			    	{{ Form::label('source', 'Source') }}
			    	{{ Form::text('source', $id->source,['class' => 'form-control', 'placeholder' => 'Source...']) }}
			    </div>	
			@else
			@endif
			@if($post->type === "link")
			    <div id="link" class="form-group">
			    	{{ Form::label('link', 'Put here a valid URL') }}
			    	{{ Form::text('link', $id->url,['class' => 'form-control', 'placeholder' => 'Link']) }}
			    </div>	
			@else
			@endif
			@if($post->type === "image")
			    <div id="image" class="form-group">
			    	{{ Form::file('image_post') }}
			    </div>
			    <div id="source" class="form-group">
			    	{{ Form::label('source', 'Source') }}
			    	{{ Form::text('source', $id->source,['class' => 'form-control', 'placeholder' => 'Source...']) }}
			    </div>	
			@else
			@endif
	    {{ Form::hidden('_method','PUT') }}
	    {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
	{!! Form::close() !!}
@endsection
