
@extends('main')
@section('title','users')

@section('content')
    <div class="card">
        <div class="card-header">Useres</div>
        <div class="card-body">
            <table class="table" id="my_table">
                <thead>
                <tr>
                    <td>ID</td>
                    <td>userid</td>
                    <td>price</td>
                    <td>lst4</td>
                    <td>code</td>
                    <td>action</td>
                </tr>
                </thead>
                <tbody>
                @foreach($receipts as $receipt)
                    <h1 id="chat"></h1>
                    <tr>
                        <td>{{$receipt->id}}</td>
                        <td>{{$receipt->user->user_name }}</td>
                        <td>{{$receipt->price}}</td>
                        <td>{{$receipt->lst4}}</td>
                        <td>{{$receipt->code}}</td>
                        <td>
                            @if($receipt->confirm == 0)
                            <a href="{{url('confirm/' . $receipt->id)}}" class="btn btn-sm btn-success">confirm</a>
                                @else
                                <p class="online">Confirmed</p>
                                @endif
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
@section('script')
    <script>
        $(document).ready( function () {
            $('#my_table').DataTable();
        } );

    </script>
@endsection
