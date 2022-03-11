<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\User;
use App\Events\MyEvent;

class AjaxController extends Controller
{
    public function index(Request $request) {

        $msg = $request->msg;
        $sender_user_id = $request->sender_id;
        $receiver_user_id = $request->receiver_id;

        Message::create([
          'message' => $msg,
          'sender_user_id' => $sender_user_id,
          'receiver_user_id' => $receiver_user_id,
        ]);

        event(new MyEvent($msg, $receiver_user_id, $sender_user_id));

        FileNotification::create([
          'user_id' => $user->id,
          'message' => 'Naujas failas: '.toLongString($file->getClientOriginalName()),
          'link' => 'chatting',
          'fileId' => $naujasFile->id,
          ]);

        return response($request->msg);
    }

    public function changeAvatar(Request $request) {

      $user=User::find($request->id);
      $user->avatar_image_number=$request->currentAvatarNumber;
      $user->save();
      return response($request->currentAvatarNumber);
  }
}
