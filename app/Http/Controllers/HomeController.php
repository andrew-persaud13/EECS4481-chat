<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Chat;
use Auth;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::allUsers();
        $chats = Auth::user()->chats()->orderby("id", "desc")->get();
        $me = Auth::user();
        $msgs = [];
        $totalMsg = Chat::chat_update($chats);
        return view('home', compact("users", "chats", "me", "msgs", "totalMsg"));
    }
}
