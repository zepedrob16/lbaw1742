@extends('layouts.app')

<?php
session_start();
$_SESSION['allposts'] = $allposts;
?>

<link rel="stylesheet" href="css/style-homepage.css">

@section('content')
	<h1>Posts</h1>
	<a href="/posts/create">Create Post</a>
    @if(count($allposts[0]) > 0)
        @foreach($allposts[0] as $post)
			<div class="row">
            <div class="col-1">
                <i class="fas fa-image"></i>
                <a href="#" class="upvote"><i class="far fa-thumbs-up"></i></a> <br>
                {{ $post->balance }}<br>
                <a href="#" class="downvote"><i class="far fa-thumbs-down"></i></a>
            </div>
            <div class="col-6">
                <a href="/posts/{{ $post->postnumber }}" id="news_title">{{ $post->title }}</a><br>
                <p>Nam consectetur iaculis imperdiet. Fusce ac eros justo. Sed vel risus ac sapien sollicitudin iaculis. Praesent non diam sapien. Curabitur et dui ut dolor mattis.</p>
                <a href="post.html" class="comments"></a>
            </div>
            <div class="col-3">
                <i class="fas fa-tv"></i> <br>
                {{ $post->author }}<br>
                <i class="fab fa-imdb"></i>{{ $allposts[4]->where('id_post', $post->postnumber)->count() }}<br>
            </div>
        </div>
		@endforeach
	@else
		<p>No posts found</p>
	@endif
@endsection



