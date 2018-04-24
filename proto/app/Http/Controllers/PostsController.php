<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Text_Post;
use App\Image_Post;
use App\Link_Post;
use App\Post_Comment;
use DB;

class PostsController extends Controller
{

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


        $allposts = array($posts,$posts_text,$posts_image,$posts_link,$posts_comment);


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
            'body' => 'required'
        ]);

        
        //Create Post
        $post = new Post;
        //$post->postnumber = $request->input('title');


        $post->title = $request->input('title');
      //  $post->body = $request->input('body');


        $post->save();

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
            'title' => 'required',
            'body' => 'required'
        ]);

        //Find Post
        $post = Post::find($postnumber);

        $post->title = $request->input('title');

        //Save Content
        $post_type = Text_Post::find($postnumber);
        if($post_type !== null){
            $post_type->opinion = $request->input('body');
        }
        if($post_type === null){
            $post_type = Image_Post::find($postnumber);
            if($post_type !== null){
                $post_type->image = $request->input('body');
             }
        }
        if($post_type === null){
            $post_type = Link_Post::find($postnumber);
            if($post_type !== null){
                $post_type->url = $request->input('body');
             }
        }
  
        
        $post->save();

        if($post_type !== null)
         $post_type->save();

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
        $post->delete();
        return redirect ('/posts')->with('success','Post Removed');
    }
}
