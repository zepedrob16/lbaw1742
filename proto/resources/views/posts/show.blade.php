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

$currUser = $allposts[5]->where('username', $post->author)->first();

?>

<meta name="csrf-token" content="{{ csrf_token() }}" />

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
			<small> Source: {{ $id->source }} </small>
		@else
			
		@endif
	</div>
	<br>
	<small>Posted by <a href="/profile/{{ $currUser->id }}">{{ $post->author }}</a> </small>
	<br>
	@if(!Auth::guest())
		@if(Auth::user()->username == $post->author)
			<a href="/posts/{{$post->postnumber}}/edit" class="btn btn-default">Edit</a>

			{!!Form::open(['action' => ['PostsController@destroy', $post->postnumber], 'method' => 'POST', 'class' => 'pull-right'])!!}
			{{Form::hidden('_method', 'DELETE')}}
			{{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
			{!!Form::close()!!}
		@endif
    @endif

    <hr>

    @if(count($allposts[4]) > 0)
        @foreach($allposts[4] as $postComment)
        	@if($postComment->id_post===$post->postnumber)
	            <div class="row">
		     	     <div class="col-10 comment">
		                <p>{!! $postComment->body !!}</p>
		                <div class="pull-right">
			                <small>commented by <a href="/profile/{{ $postComment->id_author }}">{{ $allposts[5]->where('id', $postComment->id_author)->first()->username }}</a></small>
			                <small><a href="#" class="respond">report</a></small>
			                <small><a href="#" class="respond">respond</a></small>
		            	</div>
		            </div>
	        	</div>
	        @else
	        @endif
        @endforeach
    @else
        <p>No comments for this post.</p>
    @endif

@if(!Auth::guest())
    <textarea id="commentBody" value="Comment" name="Comment" cols="55" rows="5" id="Comment"></textarea>
    <p>
        <input post="{{ $post->postnumber }}" parent="{{ 0 }}" id="comment" type="submit" name="Submit" value="Comment"> 
    </p>
@endif


<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

<script type="text/javascript">

var comment = document.getElementById('comment');

comment.addEventListener('click',function(){
    submitComment();
});

	 function submitComment(){

		var currPostnum = document.getElementById('comment').getAttribute("post");
		var parent = document.getElementById('comment').getAttribute("parent");
	 	var commentBody = document.getElementById("commentBody").value;

		$.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
		 });


		    var request = $.ajax({
		    method: 'POST',
		    url: '/addComment',
		    data: {'currPostnum' : currPostnum},
		    success: function( response ){
		        console.log( response );
		    },
		    error: function( e ) {
		        console.log(e);
		    }
		});


}

</script>

@endsection
