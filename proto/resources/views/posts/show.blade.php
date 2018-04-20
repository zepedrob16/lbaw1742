@extends('layouts.app')

@section('content')
	<a href="/posts" class="btn btn-default">Go Back</a>
	<h1>{{ $post->title }}</h1>
	<div>
		<h3> --PostImage/Text/Link-- </h3>
	</div>
	<small>Written by {{ $post->author }} </small>
@endsection