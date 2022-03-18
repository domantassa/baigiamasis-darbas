<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\User;
use App\file;
use App\Message;
use App\FileNotification;


class ChattingController extends Controller
{
    public function index($id)
    {
        $user = User::findOrFail($id);
        $messages = Message::all();
        $files = file::where('owner_id', $id)->get();

        $messagesFromReceiver = Message::where('sender_user_id', $user->id)
        ->where('receiver_user_id', 1)->get();

        foreach ($messagesFromReceiver as $message) {
            if($message->seen_date == null) {
                $message->seen_date = date('Y-m-d H:i:s',date('U'));
                $message->save();
            }
        }

        $messagesFromSender = Message::where('sender_user_id', 1)
        ->where('receiver_user_id', $user->id);

        foreach ($messagesFromSender as $message) {
            if($message->seen_date == null) {
                $message->seen_date = date('Y-m-d H:i:s',date('U'));
                $message->save();
            }
        }

        return view('chat/chatting', ['user' => $user, 'users' => User::all(), 'files' => $files, 'notif' => Auth()->User()->notifications()->get()]);  
    }

    public function chattingWithAdmin()
    {
        $user = Auth()->user();
        
        $messagesFromReceiver = Message::where('sender_user_id', 1)
        ->where('receiver_user_id', $user->id)->get();

        foreach ($messagesFromReceiver as $message) {
            if($message->seen_date == null) {
                $message->seen_date = date('Y-m-d H:i:s',date('U'));
                $message->save();
            }
        }

        $messagesFromSender = Message::where('sender_user_id', $user->id)
        ->where('receiver_user_id', 1);

        foreach ($messagesFromSender as $message) {
            if($message->seen_date == null) {
                $message->seen_date = date('Y-m-d H:i:s',date('U'));
                $message->save();
            }
        }

        $files = file::where('owner_id', $user->id)->get();
        return view('chat/chatting')->with(['user'=>Auth()->user(),'users' =>User::all(),'notif'=>Auth()->User()->notifications()->get()]);
    }
}

