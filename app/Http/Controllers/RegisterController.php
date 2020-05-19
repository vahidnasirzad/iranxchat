<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function registeruser(Request $request, User $user){

        if ($request->username != '' || $request->email != '' || $request->password != '' ){

            $user = new User();
            $user->user_name = $request->username;
            $user->sex = $request->radioValue;
            $user->email = $request->email;
            $user->password = hash::make($request->password);
            $user->balance = 1000;
            $count = User::count();
            if($count == 0)
                $user->role = 'superadmin';
            $user->save();
        }



        $sex = $request->radioValue;
        $username = $request->username;
        $email = $request->email;
        $password = $request->password;
        $cpassword = $request->cpassword;
        return $username . $sex . $email . $password . $cpassword;
    }
}
