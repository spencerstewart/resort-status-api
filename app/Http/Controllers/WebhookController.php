<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use function GuzzleHttp\json_decode;

use App\Message;
use App\Motd;


class WebhookController extends Controller
{
    public function handleMessage(Request $request)
    {
        $security_token = "KaLPviRJMnxqtDnVyStGFotWCPixu2OEjDnP+lZqp88=";
        // Log::error(utf8_encode($request->getContent()));
        // Log::error(json_encode($request->getContent()));
        // Log::error(json_encode($request->all()));

        $hash_expected = $request->header('authorization');
        $hash_received1 = "HMAC " . base64_encode(hash_hmac('sha256', utf8_encode($request->getContent()), $security_token, TRUE));
        $hash_received2 = "HMAC " . base64_encode(hash_hmac('sha256', json_encode($request->all()), $security_token, TRUE));

        // Log::error("Hash expected: " . $hash_expected);
        // Log::error("Hash received 1: " . $hash_received1);
        // Log::error("Hash calculated 2: " . $hash_received2);


        if (hash_equals($hash_expected, $hash_received1)) {
            // Hashes match
        }

        Message::saveMessage($request);

        return [
            'type' => 'message',
            'text' => 'Update sent to frontline webpage'
        ];
    }

    public function handleMotd(Request $request)
    {
        Log::info("[MOTD] Motd received");
        // $security_token = "KaLPviRJMnxqtDnVyStGFotWCPixu2OEjDnP+lZqp88=";
        // // Log::error(utf8_encode($request->getContent()));
        // // Log::error(json_encode($request->getContent()));
        // // Log::error(json_encode($request->all()));

        // $hash_expected = $request->header('authorization');
        // $hash_received1 = "HMAC " . base64_encode(hash_hmac('sha256', utf8_encode($request->getContent()), $security_token, TRUE));
        // $hash_received2 = "HMAC " . base64_encode(hash_hmac('sha256', json_encode($request->all()), $security_token, TRUE));

        // // Log::error("Hash expected: " . $hash_expected);
        // // Log::error("Hash received 1: " . $hash_received1);
        // // Log::error("Hash calculated 2: " . $hash_received2);


        // if (hash_equals($hash_expected, $hash_received1)) {
        //     // Hashes match
        // }

        Log::info("[MOTD] Saving Motd");
        Motd::saveMessage($request);

        return [
            'type' => 'message',
            'text' => 'Message of the day saved to frontline webpage'
        ];
    }

    public function index()
    {
        return [
            'type' => 'message',
            'text' => 'This is my reply'
        ]; 
    }
}


// dqxv3V6L7XxnrgVdSaHDf8pdk7rnTMn+j8lkbXrnF8A=