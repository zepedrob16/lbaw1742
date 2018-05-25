<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\User;
use App\FriendRequest;
use App\Friendship;
use App\Conversation_Message;

use DB;

class SendMessageController extends Controller
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
        $user = User::find($id);

        $info = array($user, auth()->user()->id);

        return view('profile.send_message')->with('info', $info);
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

    public function send_new_message(Request $request) {

        $data = $request->all();

        $id_user = $data['message'][0];

        $title = $data['message'][1];

        $body = $data['message'][2];

        $message = new Conversation_Message;

        $message->id_sender = auth()->user()->id;
        $message->id_recipient = $id_user;
        $message->body = $body;
        $message->title = $title;
        $message->time_stamp = date("Y-m-d H:i:s");
        $message->read = 0;

        $message->save();

        return response()->json(['message' => 'successfull','info' => '+1 post dislike'],200);
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
