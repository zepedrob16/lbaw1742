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
use App\Report;

use DB;

class AdminReportController extends Controller
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

        $report = Report::all();

        $info = array($user, $report);
        
        return view('admin.admin_report')->with('info', $info);
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

    public function solve_report(Request $request){
        $data = $request->all();

        $report_id = $data['report'];
        $report = Report::findOrFail($report_id);
        $report->delete();
        return response()->json(['message' => 'successful','info' => 'solved request'],200);
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


    public function ban_user(Request $request){

        $data = $request->all();

        $user_id = $data['user'];
        $user = User::findOrFail($user_id);

        $user->delete();
       
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
