<?php

namespace App\Http\Controllers;

use App\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function get_msg(Request $request){
        $user = Auth::user();
        if ($user->balance <= 0){
            return 'notenough';
        }
        $user->balance -= 50;

        $user->save();

        $chat = new Chat();
        $chat->user_id = $user->id;
        $chat->msg = $request->msg;
        $chat->save();
        return $user->balance;
    }

    public function listen(Request $request) {
        $last_id = $request->last_id;
        $messages = Chat::where('id', '>', $last_id)->orderBy('id', 'asc')->get();

        $res = '';

        foreach ($messages as $message) {

            $link = "<a href='". $message ."'></a>";

            $ago = \Carbon\Carbon::createFromTimeString($message->created_at)->ago();

            $res .= "<li class='list-group-item' data-id='$message->id'>
                        <a href='uprofile/$message->user_id'>
                        <img src='". url('uploads/avatars/' . $message->user->avatar) ."' style=\"width: 50px; height: 50px; float:left; border-radius: 50%; margin-right: 25px;\" class=\"img-circle\" alt=''>
                        </a>
                        <b>" . $message->user->user_name." : </b>
                        <small>$message->msg</small>
                        <span class='text-info' style='float: right !important;'>$ago</span>
                    </li>";
        }

        return $res;
    }
}
