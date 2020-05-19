<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{

    public function save(Request $request){
        $this->validate($request, [
            'firstname'=>'required',
            'lastname'=>'required',
            'email'=>'required',
            'age'=>'required',
            'password'=>'required'
        ]);
        $user = new User();
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->age = $request->age;
        $user->password = hash::make($request->password);
        $count = User::count();
        if($count == 0)
            $user->role = 1;
        $user->save();
        return Redirect::to('login')->with('register', 'You Are Registered!');
    }
    public function login(Request $request) {
        $this->validate($request,[
            'email'=>'required',
            'password'=>'required'
        ]);
        if(Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ], true)) {
            $user = Auth::user();
            if($user->status == 1){
                Auth::logout();
                return Redirect::to('login')->with('sus','you have to connect to support dear '. $user->firstname);
            }
            else {
                return Redirect::to('/')->with('login', $user->firstname . ' You Are Logged In!')
                    ->with('username', $user->firstname . '' . $user->lastname);
            }
        }


        else
            {
            return back()
                ->withInput();
        }
    }
    public function logout(){
        Auth::logout();
        return Redirect::to('home')->with('logout', 'You Are Logged Out!');

    }


    public function checkemail (Request $request) {
        $email = $request->email;
         $count = User::where('email', $email)->count();
            if ($count > 0){
                return "notok";
        }else{
                return 'ok';
            }
    }
    public function checkusername (Request $request) {
        $username = $request->username;
         $count = User::where('user_name', $username)->count();
            if ($count > 0){
                return "notok";
        }else{
                return 'ok';
            }
    }
}
