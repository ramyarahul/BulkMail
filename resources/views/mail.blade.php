@extends('app')
@section('content')
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Mail</h2>
            </div>
            <div class="w3-show-inline-block">
                <div class="w3-bar">
                    <a class="btn btn-success" href="{{ route('create.mail') }}">New</a>
                    <a class="btn btn-success" href="{{ route('content') }}">Compose</a>
                </div>
            </div>
        </div>
    </div><br>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Mail ID</th>
                <th>Created Date</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
        <tbody>
            @isset($list_mails)
            @foreach($list_mails as $list_mail)
            <tr>   
                <td>{{$list_mails->firstItem() + $loop->index }}</td> 
                <td>{{$list_mail->email}}</td>
                <td>{{date('d-m-Y', strtotime($list_mail->created_at))}}</td>
                <td>
                    <a class="btn btn-danger" href="{{ route('destroy.mail',encrypt($list_mail->id)) }}">Delete</a>
                </td>                  
            </tr>
            @endforeach
            @endisset    
        </tbody>
    </table>
    <div>
        {{ $list_mails->links() }}
    </div>
</div>
@endsection