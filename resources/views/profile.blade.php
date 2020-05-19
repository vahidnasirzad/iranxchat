@extends('main')
@section('title','profile')
@section('content')

    <div class="card">
        <div class="card-header">profile</div>
        <div class="card-body">
            <div class="card">
                <div class="card-header">name</div>
                <div class="card-body">

                    <img src="/uploads/avatars/{{Auth::user()->avatar}}" style="width: 150px; height: 150px; float:left; border-radius: 50%; margin-right: 25px;" class="img-circle" alt="profile">
                    <form enctype="multipart/form-data" method="post" action="{{url('editimg')}}"><br>
                        <label>Update Profile image</label> <br>
                        <input type="file"name="avatar"> <br> <br>
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="submit" class="pull-right btn btn-sm btn-success">
                    </form>
                    <hr>
                    your name is : {{\Illuminate\Support\Facades\Auth::user()->user_name}}
                    <br>
                    your balance is : {{\Illuminate\Support\Facades\Auth::user()->balance}}
                    <br>
                    your bio is : {{\Illuminate\Support\Facades\Auth::user()->bio}}
                    <br>
                    <hr>
                    <a href="{{url('editpro/'. Auth::user()->id )}}">
                        <button class="btn btn-success">edit</button> </a>
                </div>
            </div>
        </div>
    </div>


@endsection

