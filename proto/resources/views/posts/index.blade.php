@extends('layouts.app')

@section('content')
	<h1>Posts</h1>
	<a href="/posts/create">Create Post</a>
	@if(count($posts) > 0)
		@foreach($posts as $post)
			<div class="well">
				<h3><a href= "/posts/{{ $post->postnumber }}"> {{ $post->title }} </a> </h3>
			</div>
		@endforeach
	@else
		<p>No posts found</p>
	@endif
@endsection



