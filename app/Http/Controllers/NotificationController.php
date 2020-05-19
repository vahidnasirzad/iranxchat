<?php

namespace App\Http\Controllers;

use App\Conversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function index(){
        $me = Auth::user();
        $data['conversations'] = DB::table('conversations')
            ->where('receiver_id', $me->id)
            ->where('seen', 0)
            ->groupBy('sender_id')
            ->select(
                DB::raw('count(id) as count'),
                'sender_id as id'
            )
            ->get();

        return view('notification', $data);
    }
}
