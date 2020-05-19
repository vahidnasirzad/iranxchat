<?php

namespace App\Http\Controllers;

use App\Block;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlockController extends Controller
{
    public function block(User $user){
        $me = Auth::user();
        $block = new Block();
        $block->user_id = $me->id;
        $block->user_blocked_id = $user->id;
        $block->save();
        return back();
    }
    public function unblock(User $user){
        $me = Auth::user();
        $blocked = Block::where('user_id',$me->id)
            ->where('user_blocked_id', $user->id);
        $blocked->delete();
        return back();
    }
}
