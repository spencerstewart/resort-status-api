<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        Log::error($request->header('authorization'));
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