@extends('layouts.app')

<?php
session_start();
$content = $_SESSION['content'];
?>

@section('content')
	<h1>Edit Post</h1>
	{!! Form::open(['action' => ['PostsController@update', $post->postnumber], 'method' => 'POST' ]) !!}
	    <div class="form-group">
	    	{{ Form::label('title', 'Title') }}
	    	{{ Form::text('title', $post->title, ['class' => 'form-control', 'placeholder' => 'Title']) }}
	    </div>
	    <div class="form-group">
	    	{{ Form::label('body', 'Body') }}
	    	{{ Form::textarea('body', $content,['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Body Text']) }}
	    </div>
	    {{ Form::hidden('_method','PUT') }}
	    {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
	{!! Form::close() !!}
@endsection