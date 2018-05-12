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

    <br><br>
    <a href="#" id="Movies"><i class="far fa-thumbs-up"></i>Movies</a> 
    <a href="#" id="TVShow"><i class="far fa-thumbs-down"></i>TV Shows</a><br><br>

    @if(count($allposts[0]) > 0)
        @foreach($allposts[0] as $post)
            <div class="row" mediacat="{{ $post->media_category }}" id="post">
            <div class="col-1">
                <i class="fas fa-link"></i>
                <div id="balance" number={{ $post->postnumber }}>
                <p>{{ $post->balance }}</p>
                </div>
                @if(!Auth::guest())
                    <a href="#" number={{ $post->postnumber }} id="upvote" class="upvote" ><i class="far fa-thumbs-up"></i>Upvote</a> <br>
                    <a href="#" number={{ $post->postnumber }} id="downvote" class="downvote"><i class="far fa-thumbs-down"></i>Downvote</a>
                @endif
            </div>
            <div class="col-6">
                <a href="/posts/{{ $post->postnumber }}" id="news_title">{{ $post->title }}</a><br>
                <p>Nam consectetur iaculis imperdiet. Fusce ac eros justo. Sed vel risus ac sapien sollicitudin iaculis. Praesent non diam sapien. Curabitur et dui ut dolor mattis.</p>
                <a href="/posts/{{ $post->postnumber }}" class="comments">{{ $allposts[4]->where('id_post', $post->postnumber)->count() }} comments</a>
            </div>
            <div class="col-3">
                <i class="fas fa-video">{{ $post->media_category }}</i>
                <i class="fas fa-video"></i>
                <br>
                Shawshank Redemption
                <br>
                <i class="fab fa-imdb"></i>7.5<br>
            </div>
        </div>
        @endforeach
    @else
        <p>No posts found</p>
    @endif

<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

<script type="text/javascript">


var movie = document.getElementById('Movies');
var tvShow = document.getElementById('TVShow');
var allPosts = document.querySelectorAll('#post');

movie.addEventListener('click',function(){
    handle_movie();
});

tvShow.addEventListener('click',function(){
    handle_tvShow();
});

function handle_movie(){
for(var i = 0; i < allPosts.length; i++){
    if(allPosts[i].getAttribute("mediacat") != "Movie")
        allPosts[i].style.display = 'none';
    else
        allPosts[i].style.display = 'block';
 }  
}

function handle_tvShow(){
 for(var i = 0; i < allPosts.length; i++){
    if(allPosts[i].getAttribute("mediacat") != "TV Show")
        allPosts[i].style.display = 'none';
    else
        allPosts[i].style.display = 'block';
 }     
}

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


$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
 });


    var request = $.ajax({
    method: 'POST',
    url: 'increment',
    data: {'currPostnum' : currPostnum},
    success: function( response ){
        console.log( response );
    },
    error: function( e ) {
        console.log(e);
    }
});

request.done(function(response) {
  
if(response.message=="successfull"){

    var request2 = $.ajax({
        method: 'GET',
        url: 'getbalancepost',
        data: {'currPostnum' : currPostnum},
        success: function( response ){
            console.log( response );
        },
        error: function( e ) {
            console.log(e);
        }
    });

request2.done(function(msg) {
      for(var i = 0 ; i < allBalance.length; i++){
        if(allBalance[i].getAttribute("number") == currPostnum){
            var newLikes = msg.info;
            allBalance[i].innerHTML="<p>"+newLikes+"</p>";
        }
    }  
});


}

});

}

 function downvote(downvoteNumb){

 var currPostnum = downvoteNumb.getAttribute("number");

$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
 });

    var request = $.ajax({
    method: 'POST',
    url: 'decrement',
    data: {'currPostnum' : currPostnum},
    success: function( response ){
        console.log( response );
    },
    error: function( e ) {
        console.log(e);
    }
});


request.done(function(response) {
  
if(response.message=="successfull"){

    var request2 = $.ajax({
        method: 'GET',
        url: 'getbalancepost',
        data: {'currPostnum' : currPostnum},
        success: function( response ){
            console.log( response );
        },
        error: function( e ) {
            console.log(e);
        }
    });

request2.done(function(msg) {
      for(var i = 0 ; i < allBalance.length; i++){
        if(allBalance[i].getAttribute("number") == currPostnum){
            var newLikes = msg.info;
            allBalance[i].innerHTML="<p>"+newLikes+"</p>";
        }
    }  
});


}

});
 
}

</script>

@endsection



