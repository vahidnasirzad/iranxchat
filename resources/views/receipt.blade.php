@extends('main')

@section('title', 'Register')
@section('content')
    <div class="card">
        <div class="card-header">receipt</div>
        <div class="card-body">
            <form method="post" action="{{url('receipt')}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="price">price</label>
                    <input type="text" name="price" class="form-control" id="" aria-describedby="emailHelp" placeholder="price">
                </div>
                <div class="form-group">
                    <label for="last4">last 4 num</label>
                    <input type="text" name="lst4" class="form-control" id="" aria-describedby="emailHelp" placeholder="last4num">
                </div>
                <div class="form-group">
                    <label for="code">code rahgiri</label>
                    <input type="text" name="code" class="form-control" id="" aria-describedby="emailHelp" placeholder="code rahgiri">
                </div>
                <button type="submit" class="btn btn-primary">pardakht</button>
            </form>
        </div>
    </div>

@endsection
