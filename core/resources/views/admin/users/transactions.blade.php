@extends('layouts.admin')
@section('content')
<div class="tile">
    
    <table class="table table-responsive-lg" id="sampleTable">
        <thead>
            <tr>
                <th class="text-center">User</th>
                <th class="text-center">Amount</th>
                <th class="text-center">Balance</th>
                <th class="text-center">Details</th>
                <th class="text-center">Trx ID</th>
                <th class="text-center">Trx Time</th>
            </tr>
        </thead>
        
        @foreach($transactions as $log)
        <tr class="{{$log->type==1?'text-success':'text-danger'}}">
            <td class="text-center"><a href="{{route('admin.user-single', $log->user->id)}}"> {{$log->user->name}}</a></td>
            <td class="text-center">{{round($log->amount,$gnl->decimal)}} {{$gnl->cur}}</td>
            <td class="text-center">{{round($log->balance,$gnl->decimal)}} {{$gnl->cur}}</td>
            <td class="text-center">{{$log->details}}</td>
            <td class="text-center">{{$log->trxid}}</td>
            <td class="text-center">{{$log->created_at}}</td>
        </tr>
        @endforeach
    </table>
    <div class="text-center">
        {{$transactions->links()}}
    </div>
</div>      
@endsection
@section('page_scripts')
<script type="text/javascript" src="{{asset('assets/admin/js/plugins/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/admin/js/plugins/dataTables.bootstrap.min.js')}}"></script>
<script type="text/javascript">$('#sampleTable').DataTable();</script>
@endsection