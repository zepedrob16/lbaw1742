<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Post;
use App\Text_Post;
use App\Image_Post;
use App\Link_Post;
use App\Post_Comment;
use App\Post_Reaction;
use App\Media_Category;
use App\User_table;
use DB;

class PostsController extends Controller
{
    public function __construct(){

        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    /*
        //tudo
        $posts = Post::all();

        //especificar
        return Post::where('title', 'Post Two')->get();

        //usar DB
        $posts = DB:select('SELECT * FROM posts');

        //pagination
        $posts = Post::orderBy('title', 'desc')->paginate(1);
        colocar     {{ $posts->links() }}  depois do @endforeach em index.blade
    */

        $posts = Post::orderBy('title','asc')->get();

        $posts_text = Text_Post::orderBy('id_post','asc')->get();
        $posts_image = Image_Post::orderBy('id_post','asc')->get();
        $posts_link = Link_Post::orderBy('id_post','asc')->get();

        $posts_comment = Post_Comment::all();
        $users = User_Table::all();


        $allposts = array($posts,$posts_text,$posts_image,$posts_link,$posts_comment,$users);


        return view('posts.index')->with('allposts',$allposts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => 'required',
            'typepost' => 'required'
        ]);

        $typeOfPost = $_POST['typepost'];

        if($typeOfPost === "text")
        {
            $this->validate($request, [
            'body' => 'required',
            'source' => 'required'
        ]);
        }

        else if($typeOfPost === "link")
        {
            $this->validate($request, [
            'link' => 'required',
        ]);
        }

        else if ($typeOfPost === "image") {
            $this->validate($request, [
            'image_post' => 'required',
            'source' => 'required'
        ]);            
        }

        //Create Post
        $post = new Post;

        $post->title = $request->input('title');
        $post->type = $typeOfPost;
        $post->upvotes = 0;
        $post->downvotes = 0;
        $post->balance = 0;
        $post->author = Auth::user()->username;

        $post->save();
    
        if($typeOfPost === "text"){
            
            $post_text = new Text_Post;
            $post_text->id_post = $post->postnumber;
            $post_text->opinion = $request->input('body');
            $post_text->source = $request->input('source');

            $post_text->save();
        }

        else if ($typeOfPost === "link"){

            $post_link = new Link_Post;
            $post_link->id_post = $post->postnumber;
            $post_link->url = $request->input('link');

            $post_link->save();
        }

        else {

            $post_image = new Image_Post;
            $post_image->id_post = $post->postnumber;
            $post_image->source = $request->input('source');

            // Handle File Upload
            if($request->hasFile('image_post')){
                // Get filename with the extension
                $filenameWithExt = $request->file('image_post')->getClientOriginalName();
                // Get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                // Get just ext
                $extension = $request->file('image_post')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore= $filename.'_'.time().'.'.$extension;
                // Upload Image
                $path = $request->file('image_post')->storeAs('public/post_images', $fileNameToStore);
            } else {
                $fileNameToStore = 'noimage.jpg';
            }

            $post_image->image = $fileNameToStore;

            $post_image->save();
        }


        return redirect('/posts')->with('success', 'Post Created');
        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($postnumber)
    {
       $post =  Post::find($postnumber);
       return view('posts.show')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($postnumber)
    {
        $post =  Post::find($postnumber);

        //Check for correct user
        if(auth()->user()->username !== $post->author){
            return redirect('/posts')->with('error','Unauthorized Page');
        }

        return view('posts.edit')->with('post',$post);
      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $postnumber)
    {
        $this->validate($request, [
            'title' => 'required'
        ]);

        //Find Post
        $post = Post::find($postnumber);

        if($post->type === "text")
        {
            $this->validate($request, [
            'body' => 'required',
            'source' => 'required'
        ]);
        }

        else if($post->type === "link")
        {
            $this->validate($request, [
            'link' => 'required',
        ]);
        }

        else if ($post->type === "image") {
            $this->validate($request, [
            'source' => 'required'
        ]);            
        }

        $post->title = $request->input('title');

        if($post->type === "text"){
            $sub_post = Text_Post::find($postnumber);
            $sub_post->opinion = $request->input('body');
            $sub_post->source = $request->input('source');
        }

        else if($post->type === "link"){
            $sub_post = Link_Post::find($postnumber);
            $sub_post->url = $request->input('link');
        }
        else if($post->type === "image"){
            $sub_post = Image_Post::find($postnumber);

            // Handle File Upload
            if($request->hasFile('image_post')){
                // Get filename with the extension
                $filenameWithExt = $request->file('image_post')->getClientOriginalName();
                // Get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                // Get just ext
                $extension = $request->file('image_post')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore= $filename.'_'.time().'.'.$extension;
                // Upload Image
                $path = $request->file('image_post')->storeAs('public/post_images', $fileNameToStore);

                $sub_post->image = $fileNameToStore;
            }
            
            $sub_post->source = $request->input('source');
        }


        $post->save();

        $sub_post->save();

        return redirect('/posts')->with('success', 'Post Updated');     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($postnumber)
    {
        $post = Post::find($postnumber);

        //Check for correct user
        if(auth()->user()->username !== $post->author){
            return redirect('/posts')->with('error','Unauthorized Page');
        }

        if($post->type === "text"){
            $sub_post = Text_Post::find($postnumber);
            $sub_post->delete();
        }
        else if($post->type === "link"){
            $sub_post = Link_Post::find($postnumber);
            $sub_post->delete();
        }
        else {
            $sub_post = Image_Post::find($postnumber);
            $sub_post->delete();
        }

        Post_Reaction::where('postnumber', $postnumber)->delete();


/*
        $commentsRelated = Post_Comment::where('id_post', $postnumber);
        $commentsRelated->delete();
        

        $reactionsRelated = Post_Reaction::where('id', $postnumber);
        $reactionsRelated->delete();

        $mediaCatRelated = Media_Category::where('cat_id', $postnumber);
        $mediaCatRelated->delete();
*/
        $post->delete();

        return redirect ('/posts')->with('success','Post Removed');
    }

    public function incrementPostLikes(Request $request){

        $allReactions = Post_Reaction::all();
        $exists="no";

        $data = $request->all(); // This will get all the request data.

        $id = $data['currPostnum'];

        $post = Post::find($id);

        //Create Post Reaction
            $postReaction = new Post_Reaction;
            $postReaction->postnumber=$post->postnumber;
            $postReaction->balance=1;
            $postReaction->reactor=auth()->user()->id;
            $userPost=DB::table('users')->where('username', $post->author)->first()->id;
            $postReaction->reacted=$userPost;
            

           foreach ($allReactions as $key => $val) {
               if ($val['postnumber'] === $postReaction->postnumber &&
                   $val['reactor'] === $postReaction->reactor &&
                   $val['reacted'] === $postReaction->reacted) {
                   $exists = "yes"; $save=$val;
               }
           }
        if($exists=="no"){
            $postReaction->save();
            $post->upvotes=$post->upvotes+1;
            $post->balance=$post->upvotes+$post->downvotes;
            $post->save();
            return response()->json(['message' => 'successfull','info' => '+1 post like'],200);
        }

        else if ($exists=="yes" && $save['balance'] === -1){

            $save->balance=1;
            $save->save();
            $post->upvotes=$post->upvotes+1;
            $post->downvotes=$post->downvotes-1;
            $post->balance=$post->upvotes+$post->downvotes;
            $post->save();
            return response()->json(['message' => 'successfull','info' => '+1 post like'],200);

        }
        else if($exists=="yes" && $save['balance'] === 1){

            $save->delete();
            $post->upvotes=$post->upvotes-1;

            $post->balance=$post->upvotes+$post->downvotes;
            $post->save();
            return response()->json(['message' => 'successfull','info' => 'like deleted'],200);
        }

        return response()->json(['message' => 'unsuccessfull','info' => 'not allowed'],200);
    }

    public function decrementPostLikes(Request $request){

        $allReactions = Post_Reaction::all();
        $exists="no";

        $data = $request->all(); // This will get all the request data.

        $id = $data['currPostnum'];

        $post = Post::find($id);

        //Create Post Reaction
            $postReaction = new Post_Reaction;
            $postReaction->postnumber=$post->postnumber;
            $postReaction->balance=-1;
            $postReaction->reactor=auth()->user()->id;
            $userPost=DB::table('users')->where('username', $post->author)->first()->id;
            $postReaction->reacted=$userPost;

           foreach ($allReactions as $key => $val) {
               if ($val['postnumber'] === $postReaction->postnumber &&
                   $val['reactor'] === $postReaction->reactor &&
                   $val['reacted'] === $postReaction->reacted) {
                   $exists = "yes"; $save=$val;
               }
           }

        if($exists=="no"){

            $postReaction->save();
            $post->downvotes=$post->downvotes-1;
            $post->balance=$post->upvotes+$post->downvotes;
            $post->save();
            return response()->json(['message' => 'successfull','info' => '+1 post dislike'],200);
        }

        else if($exists=="yes" && $save['balance'] === 1){

            $save->balance=-1;
            $save->save();
            $post->upvotes=$post->upvotes-1;
            $post->downvotes=$post->downvotes-1;

            $post->balance=$post->upvotes+$post->downvotes;
            $post->save();
            return response()->json(['message' => 'successfull','info' => '+1 post dislike'],200);
            
        }
        else if($exists=="yes" && $save['balance'] === -1){

            $save->delete();
            $post->downvotes=$post->downvotes+1;

            $post->balance=$post->upvotes+$post->downvotes;
            $post->save();
            return response()->json(['message' => 'successfull','info' => 'dislike deleted'],200);
            
        }

        
        return response()->json(['message' => 'unsuccessfull','info' => 'not allowed'],200);
        
    }

    public function getBalancePost(Request $request){

        $data = $request->all(); // This will get all the request data.

        $id = $data['currPostnum'];

        $post = Post::find($id);

        return response()->json(['message' => 'balance','info' => $post->balance],200);
    }

    public function getAllPosts(Request $request){

        $posts = Post::orderBy('title','asc')->get();

        $posts_text = Text_Post::orderBy('id_post','asc')->get();
        $posts_image = Image_Post::orderBy('id_post','asc')->get();
        $posts_link = Link_Post::orderBy('id_post','asc')->get();

        $posts_comment = Post_Comment::all();
        $users = User_Table::all();

        $allposts = array($posts,$posts_text,$posts_image,$posts_link,$posts_comment,$users);

        return response()->json(['message' => $allposts],200);
    }

     public function addComment(Request $request){

            $data = $request->all(); 

            $postnumber = $data['currPostnum'];
            $postCommentBody = $data['commentBody'];
            $postCommentParent = $data['parent'];

            $post_comment = new Post_Comment;

            $post_comment->id_post = $postnumber;
            $post_comment->id_author = auth()->user()->id;
            $post_comment->id_parent = $postCommentParent;
            $post_comment->body  = $postCommentBody;
            $post_comment->time_stamp = date("Y-m-d H:i:s");

            $post_comment->save();

            //updateContent
            $posts = Post::orderBy('title','asc')->get();
            $posts_text = Text_Post::orderBy('id_post','asc')->get();
            $posts_image = Image_Post::orderBy('id_post','asc')->get();
            $posts_link = Link_Post::orderBy('id_post','asc')->get();
            $posts_comment = Post_Comment::all();
            $users = User_Table::all();
            $allposts = array($posts,$posts_text,$posts_image,$posts_link,$posts_comment,$users);
            session_start();
            $_SESSION['allposts'] = $allposts;

            return response()->json(['message' => 'successfull','info' => 'comment added'],200);
     }


}
