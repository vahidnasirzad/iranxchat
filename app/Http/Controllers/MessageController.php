<?php

namespace App\Http\Controllers;

use App\Events\FormSubmited;
use App\Events\MessageSubmited;
use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Pusher\Pusher;

class MessageController extends Controller
{
    public function index(){
        //all except Auth...
        //$users = User::where('id', '!=', Auth::id())->get();

        $users = DB::select("select users.id, users.user_name, users.email, count(is_read) as unread
        from users LEFT JOIN messages ON users.id = messages.from and is_read = 0 and messages.to =  " . Auth::id() . "
        where users.id !=  " . Auth::id() . "
        group by users.id, users.user_name,  users.email");

        return view('mychats', ['users' => $users]);
    }

    public function getMessage($user_id){
        $my_id = Auth::id();
        Message::where(['from' => $user_id, 'to' => $my_id])->update(['is_read' => 1]);
        $messages = Message::where(function ($query) use ($user_id, $my_id){
            $query->where('from', $my_id)->where('to', $user_id);
        })->orWhere(function ($query) use ($user_id, $my_id){
            $query->where('from', $user_id)->where('to', $my_id);
        })->get();

        return view('messages.index', ['messages' => $messages]);
    }

    public function sendMessage(Request $request){
        $from = Auth::id();
        $to = $request->receiver_id;
        $message = $request->message;
        $user = Auth::user();
        if ($user->balance <= 0){
            $data = json_encode([
                'balance' => 0,
                'from' => 0,
                'to' => 0,
            ]);
            event(new MessageSubmited($data));
        }else {

            $data = new Message();
            $data->from = $from;
            $data->to = $to;
            $data->message = $message;
            $data->is_read = 0;
            $data->save();


            $user->balance -= 100;
            $user->save();

            $options = array(
                'cluster' => 'eu',
                'useTLS' => true
            );

            $pusher = new Pusher(
                env('PUSHER_APP_KEY'),
                env('PUSHER_APP_SECRET'),
                env('PUSHER_APP_ID'),
                $options
            );
            //$data = ['form' => $from, 'to' => $to];

            $data = json_encode([
                'from' => $from,
                'to' => $to,
            ]);
            event(new MessageSubmited($data));
            //$pusher->trigger('my-channel', 'form-submited',$data);
        }


    }
}
