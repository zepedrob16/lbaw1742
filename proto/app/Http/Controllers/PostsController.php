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
            'typepost' => 'required'
        ]);

        $typeOfPost = $_POST['typepost'];

        //Create Post
        $post = new Post;

        $post->title = $request->input('title');
        $post->type = $typeOfPost;

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
