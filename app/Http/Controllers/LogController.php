<?php

namespace App\Http\Controllers;

use App\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function logs(Log $log){
        $data['logs'] = Log::all();
        return view('admin.user.logs', $data);
    }
}
