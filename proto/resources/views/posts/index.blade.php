@extends('layouts.app')

<?php
session_start();
$_SESSION['allposts'] = $allposts;
?>

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
-->
    <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
</head>

@section('content')
    <h1>Posts</h1>

    <br><br>
    <div class = "container">

        <!-- Tv show and movie selector -->

        <button type="button" id = "Movies" class="btn btn-default"><i class="fas fa-tv"></i>  Movies</button>
        <button type="button" id = "TVShow" class="btn btn-default"><i class="fas fa-video"></i>  TV Shows</button>


        <!-- Submit post -->
        <div class="row">
            
            <div style="margin-top: 10px; margin-left: 15px;" class="col-3">
                <a href="/posts/create"><button type="button" class="btn btn-success" id="submit">Submit Post</button></a>
            </div>
        </div>

        <!-- Display all posts -->

        @if(count($allposts[0]) > 0)
            @foreach($allposts[0] as $post)

            <div class="row" mediacat="{{ $post->media_category }}" id="post" titlePost="{{ $post->title }}">

                <!-- First Column -> Upvote, downvote and balance -->
                <div class="col-1">
     
                    @if(!Auth::guest())
                        <a href="#" number={{ $post->postnumber }} id="upvote" class="upvote"><i class="far fa-thumbs-up"></i></a>
                        <div style="margin-right: 2000px;" id="vote_balance" number={{ $post->postnumber }}>
                            <p>{{ $post->balance }}</p>
                        </div>
                        <br>
                        <a href="#" number={{ $post->postnumber }} id="downvote" class="downvote"><i class="far fa-thumbs-down"></i></a>
                    @endif
                </div>

                <!-- Second Column -> Title and preview -->
                <div class="col-6">
                    <a href="/posts/{{ $post->postnumber }}" id="news_title">{{ $post->title }}</a><br>
                    <p>{{ $post->preview }}</p>
                    <a href="/posts/{{ $post->postnumber }}" class="comments">{{ $allposts[4]->where('id_post', $post->postnumber)->count() }} comments</a>
                </div>

                <!-- Third Column -> Category, tag and score -->
                <div class="col-3">
                    @if( $post->media_category == 'TV Show')
                        <i class="fas fa-video"></i>
                    @else
                        <i class="fas fa-tv"></i>
                    @endif
                    <br>
                    @foreach($allposts[6] as $post_tag)
                    @if($post_tag->postnumber ===  $post->postnumber)
                            @foreach($allposts[7] as $media_tag)
                            @if($media_tag->tag_id ===  $post_tag->tag_id)
                                #{{ $media_tag->title }}
                             @else
                             @endif
                             @endforeach
                     @else
                     @endif
                     @endforeach
                    <br>
                </div>
            </div>
            @endforeach
        @else
            <p>No posts found</p>
        @endif

    </div>

<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

<script type="text/javascript">


var movie = document.getElementById('Movies');
var tvShow = document.getElementById('TVShow');
var allPosts = document.querySelectorAll('#post');

var searchEngine = document.getElementById('searchengine');


movie.addEventListener('click',function(){
    handle_movie();
});

tvShow.addEventListener('click',function(){
    handle_tvShow();
});


function handle_search(){
var regex = "^\\s+$";
for(var i = 0; i < allPosts.length; i++){
    if(allPosts[i].getAttribute("titlePost").toLowerCase() == searchengine.value || allPosts[i].getAttribute("titlePost").toLowerCase().includes(searchengine.value)
        || allPosts[i].getAttribute("titlePost").toUpperCase() == searchengine.value || allPosts[i].getAttribute("titlePost").toUpperCase().includes(searchengine.value)
        || allPosts[i].getAttribute("titlePost") == searchengine.value || allPosts[i].getAttribute("titlePost").includes(searchengine.value))
        allPosts[i].style.display = 'block';
    else if(allPosts[i].getAttribute("titlePost") != searchengine.value)
        allPosts[i].style.display = 'none';
 }  
 for(var i = 0; i < allPosts.length; i++){
    if(searchengine.value.match(regex) || searchengine.value == '')
        allPosts[i].style.display = 'block';
 }  
}



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

var allBalance = document.querySelectorAll('#vote_balance');

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



