@extends('layouts.user')
@section('styles')
<script>
    function createCountDown(elementId, distance) {
        var x = setInterval(function() {
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            document.getElementById(elementId).innerHTML = hours + ": "+ minutes + ": " + seconds + " ";
            if (distance < 0) {
                clearInterval(x);
                document.getElementById(elementId).innerHTML = "{{__('Transaction')}} {{__('timeout')}}";
            }
            distance = distance - 1000;
        }, 1000);
    }
</script>
@endsection
@section('content')
@php
$now = \Carbon\Carbon::now();        
@endphp
<div class="card bg-dark">
    <div class="card-header text-center">
        <h2>{{__('your')}} {{__('payments')}}</h2>
    </div>
    <div class="card-body">
        <table class="table table-responsive-lg">
            <thead>
                <tr>
                    <th class="text-center">{{__('wallet')}}</th>
                    <th class="text-center">{{__('amount')}}</th>
                    <th class="text-center">{{__('charge')}}</th>
                    <th class="text-center">USD {{__('amount')}}</th>
                    <th class="text-center">{{__('status')}}</th>
                    <th class="text-center">{{__('timeout')}}</th>
                </tr>
            </thead>
            <tbody>
                @if(count($payments)==0)
                <tr>
                    <td colspan="6" class="text-center"><h2>No Data Available</h2></td>
                </tr>
                @endif
                
                @foreach($payments as $log)
                
                @php
                $inv = \Carbon\Carbon::parse($log->created_at)->addHours(3);
                $diff = $inv->timestamp - $now->timestamp;
                $distance = $diff*1000;         
                @endphp
                <tr class="text-white">
                    <td class="text-center">{{$log->btc_wallet}}</td>
                    <td class="text-center">{{round($log->amount, $gnl->decimal)}} {{$gnl->cur}}</td>
                    <td class="text-center">{{round($log->charge, $gnl->decimal)}} {{$gnl->cur}}</td>
                    <td class="text-center">{{round($log->usd_amo, $gnl->decimal)}} USD</td>
                    <td class="text-center"> <strong class="{{$log->status == 1 ? 'text-success' : 'text-warning'}}">{{$log->status == 1 ? __('PAID') : __('PENDING')}}</strong></td>
                    <td class="text-center">
                        @if($log->status == 1)
                        <strong class="text-success">{{__('COMPLETE')}}</strong>
                        @else
                        <strong class="text-danger" id="timeOut{{$log->id}}">--:--:--</strong>
                        @endif
                    </td>
                </tr>
                <script>createCountDown('timeOut{{$log->id}}', '{{$distance}}');</script>
                @endforeach
            </tbody>
            
            
        </table>
        <div class="text-center">
            {{$payments->links()}}
        </div>
    </div>
</div>
@endsection






