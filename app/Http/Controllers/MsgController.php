<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Msg;
use App\Chat;
use Auth;

class MsgController extends Controller
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
        $this->validate($request, [
            'msg' => 'required',
            'c_id' => 'required'
        ]);

        $cu = Auth::user()->id;
        $msg = new Msg;
        $msg->msg = $request->msg;
        $msg->user_id = $cu;
        $msg->chat_id = $request->c_id;
        $msg->save();

        if (!empty($msg)) {
            $resp["status"] = 1;
            $resp['txt'] = "Successfully created a new message";
            $rest['obj'] = $msg;

            $c = Chat::find($request->c_id);
            if (count($c->msgs) > 1) {
                $resp['fst'] = 0;
            } else {
                $resp['fst'] = 1;
            }
        } else {
            $resp['status'] = 0;
            $resp['txt'] = "Something went wrong!";
        }

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

    public function messageList(Request $request)
    {
        $chat = Chat::find($request->c_id);
    
        if ($request->limit > 10) {
            $msgs = $chat->msgs()->take($request->limit)->skip($request->limit - 10)->orderBy("id", "desc")->get();
        } else {
            $msgs = $chat->msgs()->take($request->limit)->orderBy("id", "desc")->get();
        }

        $me = Auth::user();

        $resp['status'] = 1;
        $resp['txt'] = (string) view('layouts.msg-list', compact("msgs", "me"));

        return json_encode($resp);
    }

    public function newMessageList(Request $request)
    {
        $chat = Chat::find($request->c_id);
        $me = Auth::user();
    
        if ($request->me == 1) {
            $msgs = $chat->msgs()->where('user_id', '=', $me->id)->orderBy("id", "desc")->take(1)->get();
        } else {
            $msgs = $chat->msgs()->where('user_id', '<>', $me->id)->get();
        }

        if(count($msgs) > 0) {
            $resp['status'] = 1;
            $resp['txt'] = (string) view('layouts.msg-list', compact("msgs", "me"));
        } else {
            $resp['status'] = 2;
        }

       

        return json_encode($resp);
    }
}
