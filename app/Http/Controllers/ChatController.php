<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Chat;

class ChatController extends Controller
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
        $chat = new Chat;
        $chat->user_id = Auth::user()->id;
        $chat->save();
        $chat->users()->attach(Auth::user()->id); //many to many from anon
        $randomN = 0;   $resp['status'] = 200;
        $randomN = rand(1,3); //1=andrew, 2=sean, 3=sara
        $chat->users()->attach($randomN);
        $resp['status'] = 200;
        return json_encode($resp);

        $check_chats = Auth::user()->chats;

        $exists = "";
        foreach($check_chats as $ct) {
            $un= [];
            $exists = false;
            foreach($ct->users as $u) {
                if (Auth::user()->id != $u->id) {
                    $un[] = (string)$u->id;
                }
            }

            if ($request->users == $un) {
                $exists = true;
                break;
            } else {
                $exists = false;
            }
        }

        if(!$exists) {
            $chat = new Chat;
            $chat->user_id = Auth::user()->id;
            $chat->save();
            $chat->users()->attach(Auth::user()->id);
            foreach($request->users as $id) {
                $chat->users()->attach($id);
            }
            if (!empty($chat)) {
                $resp['status'] = 1;
                $resp['txt'] = "Successfully created a new chat";
                $resp['obj'] = $chat;
                $resp['objusers'] = $chat->users;
            } else {
                $resp['status'] = 0;
                $resp['txt'] = "Something went wrong...";
            }
        } else {
            $resp['status'] = 0;
            $resp['txt'] = "Chat already exists!";
        }

        return json_decode($resp);
    }
    public function transfer(Request $request) {
        $anon_id = $request->anon_id;
        $user_id = $request->user_id;

        $chat = new Chat;
        $chat->user_id = $anon_id;
        $chat->save();
        $chat->users()->attach($anon_id); 

        #i.e if Sara(3) then connect to 1 or 2 but not 3
        $randomN = 0;   
        $randomN = rand(1,3); //1=andrew, 2=sean, 3=sara
        while($randomN == $user_id) {
            $randomN = rand(1,3);
        }
        $chat->users()->attach($randomN);
        $resp['status'] = 200;
        return json_encode($resp);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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

    public function chat_list() {
        $chats = Auth::user()->chats()->orderby('id', 'desc')->get();
        $me = Auth::user();
        $resp['status'] = 1;
        $resp['txt'] = (string) view('layouts.chat_list', compact("chats", "me"));

        return json_encode($resp);

    }

    public function chatUpdate() {
        $chats = Auth::user()->chats()->orderBy('id', 'desc')->get();
        $total_msg = Chat::chat_update($chats);

        return json_encode($total_msg);
    }
}
