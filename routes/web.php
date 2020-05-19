<?php

use Illuminate\Support\Facades\Route;
use App\Events\FormSubmited;
use Illuminate\Support\Facades\Auth;
use App\Chat;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', function () {
    return view('home');
});
Route::get('home',function(){
    return view('home');
});

Route::view('register','auth.register');
Route::post('registeruser','RegisterController@registeruser');
Route::get('chatroom',function(){
    return view('chatroom');
});

Route::get('checkemail', 'AuthController@checkemail');
Route::get('checkusername', 'AuthController@checkusername');

Route::view('login', 'auth.login')->name('login');
Route::post('login', 'AuthController@login');
Route::post('saveusers','AuthController@save');

Route::post('set_last_seen', 'UserController@set_last_seen');
//Route::post('get_msg','ChatController@get_msg');

Route::post('/sender', function (){


    /*$arr = [
        "name" => 'test',
        'body' => 'test is ...'
    ];

    json_encode($arr);*/


    //this is post ...
    $msg = request()->msg;

    $user = Auth::user();
    if ($user->balance <= 0){
        return 'notenough';
    }
    $user->balance -= 50;
    $user->save();
    $user_id = Auth::user()->id;
    $chat = new Chat();
    $chat->user_id = $user_id;
    $chat->msg = $msg;
    $chat->save();

    $message = json_encode([
        'body' => $msg,
        'name' => $user->user_name,
        'img' => $user->avatar
    ]);
    event(new FormSubmited($message));


    return $user->balance;


});

Route::post('get_cnv','ConversationController@get_cnv');

Route::get('listen','ChatController@listen');
Route::get('listencnv','ConversationController@listencnv');

// when user logs in ==>>

Route::group(['middleware' => 'auth'], function () {

    Route::get('conversation/{user}', 'ConversationController@talk');

    Route::get('form', function(){
        return view('form');
    });
    Route::get('onlineusers','PageController@onlineusers');
    Route::post('save', 'FormController@save');
    Route::get('delete/{quest}','FormController@delete');
    Route::get('reply/{quest}','FormController@reply');
    Route::post('answer/{q_id}','FormController@answer');
    Route::get('question/{question}','FormController@ans');
    Route::get('del/{ans}','FormController@del');
    Route::get('editpro/{id}','UserController@editpro');
    Route::post('edited_profile/{id}','UserController@edited_profile');
    Route::post('editimg','UserController@update_avatar');
    Route::post('online_users','UserController@online_users');
    Route::get('mychats', 'MessageController@index');
    Route::get('/message/{id}', 'MessageController@getMessage')->name('message');
    Route::post('message','MessageController@sendMessage');
    Route::post('notdelete','ConversationController@notdelete');
    Route::get('logout','AuthController@logout');
    Route::get('user/{user}','UserController@user');
    Route::get('profile/{id}','UserController@profile');
    Route::get('uprofile/{id}','UserController@uprofile');
    Route::get('notification','NotificationController@index');
    Route::get('block/{user}','BlockController@block');
    Route::get('unblock/{user}','BlockController@unblock');
    Route::get('gift/{user}','PageController@gift');
    Route::view('receipt','receipt');
    Route::post('receipt','ReceiptController@receipt');

});



//  when Admin logs in ----->

Route::group(['middleware'=>'admin'],function(){

    Route::get('admin/users','admin\UserController@index');
    Route::get('deleteuser/{id}','admin\UserController@deleteuser');
    Route::get('charge1/{id}','admin\UserController@charge1');
    Route::get('charge2/{id}','admin\UserController@charge2');
    Route::get('charge3/{id}','admin\UserController@charge3');
    Route::get('adminuser/{id}','admin\UserController@adminuser');
    Route::get('useruser/{id}','admin\UserController@useruser');
    Route::get('usersus/{id}','admin\UserController@usersus');
    Route::get('userunsus/{id}','admin\UserController@userunsus');
    Route::get('checkuser', 'UserController@userOnlineStatus');
    Route::get('admin/logs','LogController@logs');

});

Route::group(['middleware'=>'superadmin'],function(){

    Route::get('admin/users','admin\UserController@index');
    Route::get('deleteuser/{id}','admin\UserController@deleteuser');
    Route::get('charge1/{id}','admin\UserController@charge1');
    Route::get('charge2/{id}','admin\UserController@charge2');
    Route::get('charge3/{id}','admin\UserController@charge3');
    Route::get('adminuser/{id}','admin\UserController@adminuser');
    Route::get('useruser/{id}','admin\UserController@useruser');
    Route::get('usersus/{id}','admin\UserController@usersus');
    Route::get('userunsus/{id}','admin\UserController@userunsus');
    Route::get('checkuser', 'UserController@userOnlineStatus');
    Route::get('admin/receipts','ReceiptController@index');
    Route::get('confirm/{price}','ReceiptController@confirm');
});



