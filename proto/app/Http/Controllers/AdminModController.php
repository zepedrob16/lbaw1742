<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\User;
use App\Post;
use App\Admin;
use App\Conversation_Message;
use App\Friendship;
use App\FriendRequest;
use App\Post_Comment;
use App\Post_Reaction;
use App\Text_Post;
use App\Link_Post;
use App\Image_Post;
use App\Media_Category;
use App\Moderator;
use App\Member;

use DB;

class AdminModController extends Controller
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
    public function show()
    {
        $user =  User::all();

        $moderator = Moderator::all();

        $info = array($user, $moderator);
        
        return view('admin.admin_mod')->with('info', $info);
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
        $user->avatar = $request->avatar;
        $user->nationality = $request->nationality;
        $user->email = $request->email;
        $user->save();
    }

    public function ban_mod(Request $request){

        $data = $request->all();

        $user_id = $data['user'];
        $user = User::findOrFail($user_id);

        $user->delete();
       
        return response()->json(['message' => 'successfull','info' => 'banned user'],200);
    }

    public function demote_mod(Request $request){

        $data = $request->all();

        $user_id = $data['user'];
        $user_mod = Moderator::findOrFail($user_id);
        $user_mod->delete();

        $user = new Member;
        $user->id_user = $user_id;
        $user->reports = 0;
        $user->save();

       
        return response()->json(['message' => 'successfull','info' => 'banned user'],200);
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
     }
}
