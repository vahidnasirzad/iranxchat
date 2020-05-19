@extends('main')
@section('title')
    ask some thing
    @endsection
@section('content')

    <form action="{{url('save')}}" method="post">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Your question</label>
            <textarea class="form-control" name="question" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Ask</button>

    </form>
    @endsection
@section('script')
    <script>
        CKEDITOR.replace( 'question' );
    </script>
    @endsection
