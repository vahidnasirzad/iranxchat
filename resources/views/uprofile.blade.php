@extends('main')
@section('title','uprofile')
@section('content')

    <div class="card">
        <div class="card-header">profile</div>
        <div class="card-body">
            <div class="card">

                @foreach($users as $user)
                <div class="card-header">{{$user->FullName()}}</div>
                <div class="card-body">

                        <img src="/uploads/avatars/{{$user->avatar}}" class="img-circle" alt="profile"> <br>

                        {!! '<br>' !!}
                        Age : {{$user->age}}
                        {!! '<br>' !!}
                        Bio : {{$user->bio}}

                    <br>
                    <a href="{{url('block/' . $user->id)}}" class="btn btn-danger">block</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


@endsection
