<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use function GuzzleHttp\json_decode;

use App\Message;


class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        $security_token = "KaLPviRJMnxqtDnVyStGFotWCPixu2OEjDnP+lZqp88=";
        Log::error(utf8_encode($request->getContent()));
        Log::error(json_encode($request->getContent()));
        Log::error(json_encode($request->all()));

        $hash_expected = $request->header('authorization');
        $hash_received1 = "HMAC " . base64_encode(hash_hmac('sha256', utf8_encode($request->getContent()), $security_token, TRUE));
        $hash_received2 = "HMAC " . base64_encode(hash_hmac('sha256', json_encode($request->all()), $security_token, TRUE));

        Log::error("Hash expected: " . $hash_expected);
        Log::error("Hash received 1: " . $hash_received1);
        Log::error("Hash calculated 2: " . $hash_received2);


        if (hash_equals($hash_expected, $hash_received1)) {
            // Hashes match
        }

        // Message::saveNewMessage($request);

        return [
            'type' => 'message',
            'text' => 'You said ' . $request->input('text')
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