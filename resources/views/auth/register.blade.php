@extends('main')

@section('title', 'Register')
@section('content')
<div class="card">
    <div class="card-header">Register</div>
    <div class="card-body">
<form method="post" action="{{url('saveusers')}}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
        <label for="firstname">First Name</label>
        <input type="text" name="firstname" class="form-control" id="firstname" aria-describedby="emailHelp" placeholder="firstname...">
    </div>
    <div class="form-group">
        <label for="lastname">Last Name</label>
        <input type="text" name="lastname" class="form-control" id="lastname" aria-describedby="emailHelp" placeholder="lastname...">
    </div>
    <div class="form-group">
        <label for="age">Age</label>
        <input type="text" name="age" class="form-control" id="age" aria-describedby="emailHelp" placeholder="Age...">
    </div>
    <div class="form-group">
        <label for="email">Email Address</label>
        <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Email...">
    </div>
    <div class="form-group">
        <label for="pass">Password</label>
        <input type="password" name="password" class="form-control" id="pass"placeholder="Password">
    </div>
    <button type="submit" class="btn btn-primary">Register</button>
</form>
    </div>
</div>

@endsection
