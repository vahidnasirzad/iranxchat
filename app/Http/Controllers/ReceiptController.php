<?php

namespace App\Http\Controllers;

use App\Receipt;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ReceiptController extends Controller
{
    public function receipt(Request $request){
        $user = Auth::user();
        $receipt = new Receipt();
        $receipt->user_id = $user->id;
        $receipt->price = $request->price;
        $receipt->lst4 = $request->lst4;
        $receipt->code = $request->code;
        $receipt->save();
        return Redirect::to('/')->with('success_msg','ya ali agha');
    }
    public function index(){
        $data ['receipts'] = Receipt::all();
        return view('admin.user.receipts',$data);
    }
    public function confirm(Receipt $price){
        $user = User::find($price->user_id);

        $user->balance += $price->price;
        $user->save();


        $price->confirm = 1;
        $price->save();

        // dd($user, $price);
        return back();

    }
}
