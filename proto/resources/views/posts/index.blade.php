@extends('layouts.app')

<?php
session_start();
$_SESSION['allposts'] = $allposts;
?>

<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="stylesheet" href="css/style-homepage.css">

@section('content')
    <h1>Posts</h1>
    <a href="/posts/create">Create Post</a>
    @if(count($allposts[0]) > 0)
        @foreach($allposts[0] as $post)
            <div class="row">
            <div class="col-1">
                <i class="fas fa-link"></i>
                <div id="balance" number={{ $post->postnumber }}>
                <p>{{ $post->balance }}</p>
                </div>
                <a number={{ $post->postnumber }} id="upvote" class="upvote" ><i class="far fa-thumbs-up"></i>Upvote</a> <br>
                <a number={{ $post->postnumber }} id="downvote" class="downvote"><i class="far fa-thumbs-down"></i>Downvote</a>
            </div>
            <div class="col-6">
                <a href="/posts/{{ $post->postnumber }}" id="news_title">{{ $post->title }}</a><br>
                <p>Nam consectetur iaculis imperdiet. Fusce ac eros justo. Sed vel risus ac sapien sollicitudin iaculis. Praesent non diam sapien. Curabitur et dui ut dolor mattis.</p>
                <a href="post.html" class="comments">{{ $allposts[4]->where('id_post', $post->postnumber)->count() }} comments</a>
            </div>
            <div class="col-3">
                <i class="fas fa-video"></i><br>
                Shawshank Redemption<br>
                <i class="fab fa-imdb"></i>7.5<br>
            </div>
        </div>
        @endforeach
    @else
        <p>No posts found</p>
    @endif

<button type="button" class="btn btn-warning" id="pedido">getRequest</button>

<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

<script type="text/javascript">

$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
 });


var id = 11; // A random variable for this example

$.ajax({
    method: 'GET',
    url: 'here',
    data: {},
    success: function( response ){
        console.log( response );
    },
    error: function( e ) {
        console.log(e);
    }
});

$.ajax({
    method: 'POST',
    url: 'here2',
    data: {'id' : id},
    success: function( response ){
        console.log( response );
    },
    error: function( e ) {
        console.log(e);
    }
});

/*
var allBalance = document.querySelectorAll('#balance');

var allUpvotes = document.querySelectorAll('#upvote');
var allDownVotes = document.querySelectorAll('#downvote');

for(var i = 0; i < allUpvotes.length; i++){
    allUpvotes[i].addEventListener('click',function(){
        upvote(this);
    });
 }  

for(var i = 0; i < allDownVotes.length; i++){
    allDownVotes[i].addEventListener('click',function(){
        downvote(this);
    });
 }  

function upvote(upvoteNumb){

    var currPostnum = upvoteNumb.getAttribute("number");

    for(var i = 0 ; i < allBalance.length; i++){
        if(allBalance[i].getAttribute("number") == currPostnum){
            var newLikes = parseInt(allBalance[i].textContent)+1;
            allBalance[i].innerHTML="<p>"+newLikes+"</p>";
        }
    }       
 
}

function downvote(downvoteNumb){

    var currPostnum = downvoteNumb.getAttribute("number");

    for(var i = 0 ; i < allBalance.length; i++){
        if(allBalance[i].getAttribute("number") == currPostnum){
            var newLikes = parseInt(allBalance[i].textContent)-1;
            allBalance[i].innerHTML="<p>"+newLikes+"</p>";
        }
    }
   // console.log(upvoteNumb);
}
*/
</script>

@endsection



