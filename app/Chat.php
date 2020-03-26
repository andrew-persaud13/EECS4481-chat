<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Msg;
use Auth;

class Chat extends Model
{
    public function users() {
        return $this->belongsToMany(User::class);
    }

    public function msgs() {
        return $this->hasMany(Msg::class);
    }

    static public function chat_update($chats) {
        $total = [];
        foreach($chats as $chat) {
            $i = 0;
            foreach ($chat->msgs as $msg) {
                if ($msg->user_id != Auth::user()->id) {
                    $i++;
                    $total[$chat->id] = $i;
                }
            }
        }
        return $total;
    }
}
