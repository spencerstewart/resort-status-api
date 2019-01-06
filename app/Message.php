<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function saveMessage($request) {
        $message = new Message;
        $message->from = $request->from;
        $message->text = $request->text;
        return $message->save();
    }
}
