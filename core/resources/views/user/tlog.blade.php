@extends('layouts.user')

@section('content')
<div class="card bg-dark">
    <div class="card-header text-center">
        <h2>{{__('Transactions')}}</h2>
    </div>
    <div class="card-body">
        <table class="table table-responsive-lg">
            <thead>
                <tr>
                    <th class="text-center">{{__('amount')}}</th>
                    <th class="text-center">{{__('balance')}}</th>
                    <th class="text-center"> {{__('Details')}}</th>
                    <th class="text-center">{{__('Transaction')}} ID</th>
                    <th class="text-center">{{__('Transaction')}} {{__('time')}}</th>
                </tr>
            </thead>
            <tbody>
                    @if(count($logs)==0)
                    <tr>
                        <td colspan="5" class="text-center"><h2>No Data Available</h2></td>
                    </tr>
                    @endif
            @foreach($logs as $log)
            <tr class="{{$log->type==1?'text-succes':'text-danger'}}">
                <td class="text-center">{{round($log->amount,$gnl->decimal)}} {{$gnl->cur}}</td>
                <td class="text-center">{{round($log->balance,$gnl->decimal)}} {{$gnl->cur}}</td>
                <td class="text-center">{{__($log->details)}}</td>
                <td class="text-center">{{$log->trxid}}</td>
                <td class="text-center">{{$log->created_at}}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <div class="text-center">
            {{$logs->links()}}
        </div>
    </div>
</div>
@endsection





