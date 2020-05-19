@extends('main')
@section('title')
    answers
    @endsection
@section('content')

    <div class="card">
        <div class="card-header">Answers</div>
        <div class="card-body">
            <div class="card-header">
                {{$question->user->firstname.$question->user->lastname}}
            </div>
            <div class="card-body">
                {{ $question->question }}


            <div class="card">
            <div class="card-header">
                {{'Answers'}}
            </div>
            <div class="card-body">
                <div class="card mt-2">
                    @foreach($answers as $ans)
                        <div class="card-header">{{$ans->user->firstname.$ans->user->lastname}}</div>
                        <div class="card-body">{{$ans->answer}}</div>
                        <div class="card-footer"><a href="{{url('del/'. $ans->id)}}" class="btn btn-danger">delete</a></div>
                        <br>
                        @endforeach
                </div>
            </div>
            </div>
        </div>

    </div>



@endsection
