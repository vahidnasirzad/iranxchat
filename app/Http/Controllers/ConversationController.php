<?php

namespace App\Http\Controllers;

use App\Block;
use App\Conversation;
use App\Log;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ConversationController extends Controller
{
    public function talk (User $user) {
        $me = Auth::user();
        $count = Block::where('user_id', $user->id)
            ->where('user_blocked_id', $me->id)
            ->count();

        if ($count > 0) {
            return Redirect::to('onlineusers')
                ->with('danger_msg', 'You are blocked!');
        }

        $users = $me->id < $user->id ? $me->id . "_" . $user->id : $user->id . "_" . $me->id;
        $data['conversations'] = Conversation::where('users', $users)->get();
        DB::table('conversations')
            ->where('users', $users)
            ->where('receiver_id', $me->id)
            ->update([
                'seen' => 1
            ]);
        $data['user'] = $user;

        return view('conversation', $data);
    }

    public function get_cnv (Request $request, Log $log) {
        $me = Auth::user();
        $user = $request->receiver;
        $users = $me->id < $user ? $me->id . "_" . $user : $user . "_" . $me->id;
        if($me->balance <= 0){
            return 'notenough';
        }

        $conversation = new Conversation();
        $conversation->users = $users;
        $conversation->sender_id = $me->id;
        $conversation->receiver_id = $user;
        $conversation->msg = $request->msg;
        $conversation->save();
        $me->balance -= 100;
        $me->save();


        $updates = Log::where('users',$users)
            ->where('sender_id', $me->id)
            ->where('receiver_id', $user)
            ->get()->count();

        if ($updates == 0){
            $log = new Log();
            $log->users = $users;
            $log->sender_id = $me->id;
            $log->receiver_id = $user;
            $log->cost += 100;
            $log->save();
        }
        if ($updates >= 1){
            $abbas = Log::where('users',$users)
                ->where('sender_id',$me->id)
                ->where('receiver_id', $user)
                ->get();
            foreach ($abbas as $ab){
                $ab->cost += 100;
                $ab->save();
            }
        }







        return $me->balance;
    }

    public function notification(Request $request){
        $me = Auth::user();
        $notification = Conversation::where('receiver_id', $me->id)
                ->where('seen', 0)
                ->count();
        return $notification;
    }

    public function listencnv(Request $request) {
        $last_id = $request->last_id;
        $me = Auth::user();
        $user = $request->user;
        $users = $me->id < $user ? $me->id . "_" . $user : $user . "_" . $me->id;
        $messages = Conversation::where('users', $users)
            ->where('id', '>', $last_id)
            ->orderBy('id', 'asc')
            ->get();
        $res = '';
        foreach ($messages as $message){
            if($me->id == $message->receiver_id){
                $message->seen = 1;
                $message->save();
            }

            $res .=  "<li class='list-group-item' data-id='$message->id'>
                        <img src='". url('uploads/avatars/' . $message->sender->avatar) ."' style=\"width: 50px; height: 50px; float:left; border-radius: 50%; margin-right: 25px;\" class=\"img-circle\" alt=''>
                        <b>".$message->sender->fullName()." : </b>
                        <small>$message->msg</small>
                        <span class='text-info' style='float: right !important;'>$message->created_at</span>
                    </li>";
        }


        return $res;
    }

}
