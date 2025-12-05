<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\Chat;
use app\Events\MessageSent;

class ChatController extends Controller
{
    public function index()
    {
        // Data chat sebagai contoh
        $messages = [
            ['sender' => 'user', 'message' => 'Assalamuallaikum', 'time' => '09:09'],
            ['sender' => 'pharmacist', 'message' => 'Wallaikumsalam', 'time' => '09:12'],
        ];

        return view('user.chat', compact('messages'));

    }
}