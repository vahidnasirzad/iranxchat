<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class PageController extends Controller
{
    public function onlineusers(){
        $data['users'] = User::where('id', '!=', Auth::user()->id);
        return view('onlineusers',$data);
    }

    public function gift(User $user){
        $user->balance += 1000;
        $user->online_from = null;
        $user->save();
        return back()->with('success_msg','You Win 1000');
    }
}
