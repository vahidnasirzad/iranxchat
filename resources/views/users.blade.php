@extends('main')
@section('title','users')
@section('content')

    <div class="card">
        <div class="card-header">{{$user->user_name}}</div>
        <div class="card-body">
            @foreach($questions as $q)
                <div class="card mt-5">
                    <div class="card-header">
                        {{$q->id}}
                    </div>
                    <div class="card-body">
                        {{$q->question}}
                    </div>
                    <div class="card-footer">

                        <a href="{{url('reply/' .$q->id)}}" class="btn btn-success">reply</a>
                        <a href="{{url('delete/' . $q->id)}}" class="btn btn-danger">delete</a>
                    </div>
                </div>
                @endforeach
        </div>
    </div>
    @endsection
