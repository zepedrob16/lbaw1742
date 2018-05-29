<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\User;
use App\FriendRequest;
use App\Friendship;
use App\Post_Reaction;
use App\Post_Comment;
use App\Post;

use DB;

class ProfileController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user =  User::find($id);

        $friend_requests = FriendRequest::where('receiver', $id)->get();

        $friends = DB::select('select * from friendship where user1 = ? or user2 = ?', [auth()->user()->id, auth()->user()->id]);

        $reactions_given = Post_Reaction::where('reactor', $id)->get();

        $comments = Post_Comment::where('id_author', $id)->get();

        $posts_made = Post::where('author', $user->username)->get();

        $info = array($user, $friend_requests, $friends, $reactions_given, $comments, $posts_made);

        
        return view('profile.showprofile')->with('info', $info);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user =  User::find($id);
        return view('profile.editprofile')->with('user',$user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user =  User::find($id);
        $user->username = $request->username;
        $user->quote = $request->quote;
        $user->nationality = $request->nationality;
        $user->email = $request->email;

        // Handle File Upload
        if($request->hasFile('image_profile')){
            // Get filename with the extension
            $filenameWithExt = $request->file('image_profile')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('image_profile')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('image_profile')->storeAs('public/post_images', $fileNameToStore);

            $user->avatar = $fileNameToStore;
        }


        $user->save();
        return redirect('/profile/'.$user->id)->with('success', 'Profile Updated'); 
    }

    public function new_friendship(Request $request) {

        $data = $request->all();

        $id_sender = $data['user'];

        $friend_request = DB::update('update friend_request set dateconfirmation = ? where receiver = ? and sender = ?', [date("Y-m-d H:i:s"), auth()->user()->id, $id_sender]);

        //$friend_request->save();

        $friendship = new Friendship;

        $friendship->start = date("Y-m-d H:i:s");
        $friendship->user1 = auth()->user()->id;
        $friendship->user2 = $id_sender;

        $friendship->save();

        return response()->json(['message' => 'successfull','info' => '+1 post dislike'],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
