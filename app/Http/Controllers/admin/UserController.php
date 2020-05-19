<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Log;
use App\User;
use Illuminate\Filesystem\Cache;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $data['users'] = User::all();
        return view('admin.user.index',$data);
    }

    public function deleteuser(User $id){
        $usersender = Log::where('sender_id', $id->id)->get();
        $userreceiver = Log::where('receiver_id',$id->id)->get();

        foreach ($usersender as $sender){
            $sender->delete();
        }
        foreach ($userreceiver as $receiver){
            $receiver->delete();
        }

        $id->delete();
        return back();
    }

    public function adminuser(User $id){
        $id->role = 'admin';
        $id->save();
        return back();
    }

    public function useruser(User $id){
        $id->role = 'user';
        $id->save();
        return back();
    }
    public function usersus(User $id){
        $id->status = 1;
        $id->save();
        return back();
    }
    public function userunsus(User $id){
        $id->status = 0;
        $id->save();
        return back();
    }
    public function charge1(User $id){
        $id->balance += 10000;
        $id->save();
        return back();
    }
    public function charge2(User $id){
        $id->balance += 50000;
        $id->save();
        return back();
    }
    public function charge3(User $id){
        $id->balance += 100000;
        $id->save();
        return back();
    }
}
