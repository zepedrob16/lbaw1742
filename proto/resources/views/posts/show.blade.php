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

$id = searchForId($post->postnumber, $allposts[1]);
$content = null;

if($id!==null)
	$content = $id->opinion;
if($id===null){
		$id = searchForId($post->postnumber, $allposts[2]);
		if($id!==null)
			$content = $id->image;
	}
if($id===null){
		$id = searchForId($post->postnumber, $allposts[3]);
		if($id!==null)
			$content = $id->url;

	}

$_SESSION['content'] = $content;
?>

@section('content')
	<a href="/posts" class="btn btn-default">Go Back</a>
	<h1>{{ $post->title }}</h1>
	<div>
		{!! $content !!}
	</div>
	<small>Posted by {{ $post->author }} </small>
	<hr>

    <a href="/posts/{{$post->postnumber}}/edit" class="btn btn-default">Edit</a>

    {!!Form::open(['action' => ['PostsController@destroy', $post->postnumber], 'method' => 'POST', 'class' => 'pull-right'])!!}
    {{Form::hidden('_method', 'DELETE')}}
    {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
    {!!Form::close()!!}

@endsection
