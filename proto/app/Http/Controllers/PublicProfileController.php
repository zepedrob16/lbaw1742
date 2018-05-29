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

class PublicProfileController extends Controller
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

        $friends = DB::select('select * from friendship where user1 = ? or user2 = ?', [auth()->user()->id, auth()->user()->id]);

        $reactions_given = Post_Reaction::where('reactor', $id)->get();

        $comments = Post_Comment::where('id_author', $id)->get();

        $posts_made = Post::where('author', $user->username)->get();

        $friend_requests = DB::select('select * from friend_request where sender = ? and receiver = ?', [auth()->user()->id, $id]);

        $info = array($user, $friends, $reactions_given, $comments, $posts_made, $friend_requests);

        return view('profile.publicprofile')->with('info', $info);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
        $user->avatar = $request->avatar;
        $user->nationality = $request->nationality;
        $user->email = $request->email;
        $user->save();
    }

    public function friend_request(Request $request) {
        $data = $request->all();

        $id_receiver = $data['user'];

        $friend_request = new FriendRequest;

        $friend_request->daterequest = date("Y-m-d H:i:s");
        $friend_request->sender = auth()->user()->id;
        $friend_request->receiver = $id_receiver;

        $friend_request->save();

   

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
