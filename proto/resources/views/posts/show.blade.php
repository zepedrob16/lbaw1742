@extends('layouts.app')

<?php
session_start();
$allposts = $_SESSION['allposts'];

function searchForId($id, $array) {
   foreach ($array as $key => $val) {
       if ($val['id_post'] === $id) {
           return $val;
       }
   }
   return null;
}

if($post->type === "text"){
	$id = searchForId($post->postnumber, $allposts[1]);
	$content = $id->opinion;
}
else if($post->type === "image"){
	$id = searchForId($post->postnumber, $allposts[2]);
	$content = $id->image;
}
else{
	$id = searchForId($post->postnumber, $allposts[3]);
	$content = $id->url;
}

$_SESSION['content'] = $content;
$_SESSION['id'] = $id;

//$user = $allposts[5]->where('username', $post->author);

?>

@section('content')
	<a href="/posts" class="btn btn-default">Go Back</a>
	<h1>{{ $post->title }}</h1>
	<div>
		@if($post->type === "image")
			<img style="width:50%" src="/storage/post_images/{{ $content }}">
		@else
			{!! $content !!}
		@endif
	</div>
	<br><br><br><br>
	<div>
		@if($post->type === "text" || $post->type === "image")
			<small>Source: {{ $id->source }} </small>
		@else
			
		@endif
	</div>
	<br>
	<small>Posted by {{ $post->author }} </small>

	<hr>
	

	@if(!Auth::guest())
		
			<a href="/posts/{{$post->postnumber}}/edit" class="btn btn-default">Edit</a>

			{!!Form::open(['action' => ['PostsController@destroy', $post->postnumber], 'method' => 'POST', 'class' => 'pull-right'])!!}
			{{Form::hidden('_method', 'DELETE')}}
			{{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
			{!!Form::close()!!}
		
    @endif

@endsection
