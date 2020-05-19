@extends('main')
@section('title')
    question
    @endsection
@section('content')
    <div class="card">
        <div class="card-header">QUESTIONS</div>
        <div class="card-body">
            @foreach($questions as $quest)
                <div class="card mt-2">
                    <div class="card-header">
                        <a href="{{'user/' . $quest->user->id}}"> {{$quest->user->firstname . ' ' .$quest->user->lastname}} </a>
                    </div>
                    <div class="card-body">
                        {!! $quest->question !!}
                    </div>
                    <div class="card-footer">
                        <a href="{{url('reply/' .$quest->id)}}" class="btn btn-success">reply</a>
                        <a href="{{url('delete/' . $quest->id)}}" class="btn btn-danger">delete</a>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

    @endsection
