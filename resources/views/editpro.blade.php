@extends('main')

@section('title', 'Register')
@section('content')
    <div class="card">
        <div class="card-header">Edit Profile</div>
        <div class="card-body">
            <form method="post" action="{{url('edited_profile/'.Auth::user()->id)}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="firstname">First Name</label>
                    <input type="text" name="firstname" value="{{Auth::user()->firstname}}" class="form-control" id="firstname" aria-describedby="emailHelp" placeholder="firstname...">
                </div>
                <div class="form-group">
                    <label for="lastname">Last Name</label>
                    <input type="text" name="lastname" value="{{Auth::user()->lastname}}" class="form-control" id="lastname" aria-describedby="emailHelp" placeholder="lastname...">
                </div>
                <div class="form-group">
                    <label for="age">Age</label>
                    <input type="text" name="age" value="{{Auth::user()->age}}" class="form-control" id="age" aria-describedby="emailHelp" placeholder="Age...">
                </div>
                <div class="form-group">
                    <label for="Bio">Bio</label>
                    <input type="text" name="bio" value="{{Auth::user()->bio}}" class="form-control" id="bio" aria-describedby="emailHelp" placeholder="bio...">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

@endsection
