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
	<small>Posted by <a href="/publicprofile/{{ $currUser->id }}">{{ $post->author }}</a> </small>
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
	<div id="comments" class="row">
    @if(count($allposts[4]) > 0)
        @foreach($allposts[4] as $postComment)
        	@if($postComment->id_post===$post->postnumber)
		     	     <div class="col-10 comment">
		                <p>{!! $postComment->body !!}</p>
		                <div class="pull-right">
			                <small>commented by <a href="/profile/{{ $postComment->id_author }}">{{ $allposts[5]->where('id', $postComment->id_author)->first()->username }}</a></small>
			                <small><a href="#" class="report">report</a></small>
			                <small><a href="#" class="respond">respond</a></small>
		            	</div>
		            </div>
	        @else
	        @endif
        @endforeach
    @else
        <p>No comments for this post.</p>
    @endif
	</div>

@if(!Auth::guest())
    <textarea id="commentBody" value="Comment" name="Comment" cols="55" rows="5" id="Comment"></textarea>
    <p>
        <input post="{{ $post->postnumber }}" parent="{{ 0 }}" id="comment" type="submit" name="Submit" value="Comment"> 
    </p>
@endif


<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

<script type="text/javascript">

var comment = document.getElementById('comment');
var comments = document.getElementById("comments");

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
		    data: {'currPostnum' : currPostnum, 'commentBody' : commentBody, 'parent' : parent},
		    success: function( response ){
		        console.log( response );
		    },
		    error: function( e ) {
		        console.log(e);
		    }
		});

		request.done(function(response) {
		  
		if(response.message=="successfull"){

				//comment div
				var newComment = document.createElement('div');
				newComment.className='col-10 comment';

				//comment content
				var paragraph = document.createElement('p');
				paragraph.textContent = commentBody;

				newComment.appendChild(paragraph);

				//div for comment identifier, respond and report
				var divActions = document.createElement('div');
				divActions.className='pull-right';

				var commentedBy = document.createElement('small');
				commentedBy.textContent = 'commented by ';

				@if(!Auth::guest())
					var anchor = document.createElement('a');
					anchor.setAttribute("href", "/profile/{{ Auth::user()->id }}" );
					anchor.textContent = "{{ Auth::user()->username }}";
				@endif

				var report = document.createElement('small');
				var respond = document.createElement('small');

				var anchor2 = document.createElement('a');
				anchor2.setAttribute("href", "#" );
				anchor2.textContent = " report";
				anchor2.className = "report";

				var anchor3 = document.createElement('a');
				anchor3.setAttribute("href", "#" );
				anchor3.textContent = " respond";
				anchor3.className="respond";


				commentedBy.appendChild(anchor);
				report.appendChild(anchor2);
				respond.appendChild(anchor3);
				divActions.appendChild(commentedBy);
				divActions.appendChild(report);
				divActions.appendChild(respond);

				newComment.appendChild(divActions);
				comments.appendChild(newComment);

				console.log(comments);

		}

		});


}

</script>




@endsection
