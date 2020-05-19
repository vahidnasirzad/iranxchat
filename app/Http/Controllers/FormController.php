<?php

namespace App\Http\Controllers;

use App\questions;
use App\Reply;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class FormController extends Controller
{
    public function save(Request $request){
        $questions = new questions();
        $questions->user_id = Auth::user()->id;
        $questions->question = $request->question;
        $questions->save();
        return Redirect::to('questions');
    }


    public function questions(){
    $data['questions'] = questions::orderby('id')->get();
    return view('questions',$data);
    }

    public function delete(questions $quest){
        $quest->delete();

        return back();
    }
    public function reply(questions $quest){
        $data['q'] = $quest;
        return view('reply', $data);
    }
    public function answer(Request $request){
        $answer = new Reply();
        $answer->questions_id = $request->question_id;
        $answer->user_id = Auth::user()->id;
        $answer->answer = $request->answer;
        $answer->save();

        return Redirect::to('question/' . $request->question_id);
    }
    public function ans(questions $question){
        $data['question'] = $question;
        $data['answers'] = Reply::where('questions_id', $question->id)
            ->orderBy('id', 'desc')
            ->get();
        // dd($data['question']);
        return view('answers', $data);
    }

    public function del(Reply $ans){
        $ans->delete();
        return back();
    }

}
