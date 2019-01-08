<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Motd extends Model
{
    public static function saveMessage($request) {
        $data = json_decode($request->getContent(), true);
        
        Log::error($data);
        // Log::error('from name: ' . $request->from['name']);
        // Log::error('message text: ' . $request->text);
        // Log::error('channel id: ' . $request->channelData['channel']['id']);
        // Log::error('convo id: ' . $request->conversation['id']);
        // Log::error('team id: ' . $request->channelData['team']['id']);

        $message = new Motd;
        $message->from = $request->from['name'];
        $message->message = $request->attachments[0]['content'];
        $message->channel_id = $request->channelData['channel']['id'];
        $message->conversation_id = $request->conversation['id'];
        $message->teams_id = $request->channelData['team']['id'];
        return $message->save();
    }
}
