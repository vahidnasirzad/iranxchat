@extends('main')
@section('title')
    reply
    @endsection
@section('content')

    <div class="card">
        <div class="card-header">QUESTION {{$q->id}}</div>
        <div class="card-body">
                <div class="card mt-2">
                    <div class="card-header">{{$q->name}}</div>
                    <div class="card-body">
                        {{$q->question}}
                    </div>
                    <div class="card-footer">
                        {{ $q->user->firstname . ' ' . $q->user->lastname }}
                    </div>
                </div>
        </div>

    </div>




    <div class="card">
        <div class="card-header">reply Post {{ $q->id }}</div>
        <div class="card-body">
            <form method="post" action="{{ url('answer/' . $q->id) }}">

                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="question_id" value="{{$q->id}}">

                <div class="form-group">
                    <label for="body">Answer</label>
                    <textarea name="answer" id="body" class="form-control" rows="10"></textarea>

                </div>

                <button type="submit" class="btn btn-block btn-primary">reply</button>
            </form>
        </div>
    </div>
    @endsection
