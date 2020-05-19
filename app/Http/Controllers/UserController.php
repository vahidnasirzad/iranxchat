<?php

namespace App\Http\Controllers;

use App\questions;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Image;

class UserController extends Controller
{
    public function user(User $user){
        $data['user'] = $user;
        $data['questions'] = questions::where('user_id',$user->id)->get();
        return view('users',$data);

    }

    public function set_last_seen() {
        $user = Auth::user();
        $now = Carbon::now()->format("Y-m-d H:i:s");
        $user->last_seen = $now;
        $user->save();

        $now_time = Carbon::now();
        if ($user->online_from != null) {
            $diff = Carbon::createFromTimeString($user->online_from)->diffInMinutes($now_time);
            if ($diff > 11) {
                $user->online_from = $now;
                $user->save();
            }
        } else {
            $user->online_from = $now;
            $user->save();
        }

        $diff = Carbon::createFromTimeString($user->online_from)->diffInMinutes($now_time);
        if ($diff > 10)
            return 'gift';
        else
            return 'nothing';
    }

    public function online_users() {
        $users = User::all();
        $response = [];
        foreach ($users as $user){
            if($user->last_seen != null) {
                $now = Carbon::now();
                $user_last_seen = Carbon::createFromTimeString($user->last_seen);
                $diff = $now->diffInSeconds($user_last_seen);
                $response[$user->id] = $diff > 30 ? 'Offline' : "Online";
            } else {
                $response[$user->id] = 'Offline';
            }
        }
        return response()->json($response);
    }

    public function set_last_search (Request $request) {
        $key = $request->key;
        $user = Auth::user();
        $user->last_search = $key;
        $user->save();
        return $key;
    }
    public function chat(Request $request){
        $chat = $request->chat;
        $user = Auth::user();
        $user->chat = $chat;
        $user->save();
        return $chat;
    }
    public function profile(User $id){
        $user['users'] = Auth::user();
        return view('profile',$user);
    }

    public function uprofile(User $id){
        $data['users'] = User::where('id',$id->id)->get();
        return view('uprofile', $data);
    }
    public function editpro(User $id){
        $data['user'] = User::where('id',$id->id)->get();
        return view('editpro',$data);
    }
    public function edited_profile(Request $request){
        $user = Auth::user();
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->age = $request->age;
        $user->bio = $request->bio;
        $user->save();
        return view('profile');
    }
    public function update_avatar(Request $request){
        if ($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/avatars/' . $filename));
            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();
        }
        return view('profile', array('user'=>Auth::user()));
    }
}
