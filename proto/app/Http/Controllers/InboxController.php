<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Conversation_Message;
use App\User;
use App\InboxMessage;

use DB;

class InboxController extends Controller
{
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
        $conversation = DB::select('select * from conversation_message where id_recipient = ? order by time_stamp DESC', [$id]);

        $user = User::all();

        $info = array($conversation, $user);

        return view('profile.inbox')->with('info', $info);
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
        
    }

    public function read_message(Request $request) {

        $data = $request->all();

        $id = $data['id'];

        $conversation = InboxMessage::find($id);

        $conversation->read = 1;
        $conversation->save();


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
