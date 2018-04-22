@extends('layouts.app')

@section('content')
	<a href="/posts" class="btn btn-default">Go Back</a>
	<h1>{{ $post->title }}</h1>
	<div>
		{!! $post->body !!}
	</div>
	<div>
		<h3> --PostImage/Text/Link-- </h3>
	</div>
	<small>Written by {{ $post->author }} </small>
	<hr>

    <a href="/posts/{{$post->postnumber}}/edit" class="btn btn-default">Edit</a>

    {!!Form::open(['action' => ['PostsController@destroy', $post->postnumber], 'method' => 'POST', 'class' => 'pull-right'])!!}
    {{Form::hidden('_method', 'DELETE')}}
    {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
    {!!Form::close()!!}

@endsection
