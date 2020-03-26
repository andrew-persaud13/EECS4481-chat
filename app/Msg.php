<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Msg extends Model
{
    public function chat() {
        return $this->belongsTo(Chat::class);
    }
}
