@extends('layouts.user')

@section('content')

<div class="card">
    <div class="card-header text-center">
        <h3>Deposit Preview</h3>
        @include('layouts.error') 
    </div>
    <div class="card-body text-center">
        <form method="POST" action="{{ route('deposit.confirm') }}">
            @csrf
            <input type="hidden" name="gateway" value="{{$data->gateway_id}}"/>
            <ul class="list-group text-center">
                <li class="list-group-item"><img src="{{asset('assets/images/gateway')}}/{{$data->gateway_id}}.jpg" style="max-width:100px; max-height:100px; margin:0 auto;"/></li>
                <li class="list-group-item">Amount: <strong>{{round($data->amount,$gnl->decimal)}} {{$gnl->cur}}</strong></li>
                <li class="list-group-item">Charge: <strong>{{round($data->charge,$gnl->decimal)}} {{$gnl->cur}}</strong></li>
                <li class="list-group-item">Payable: <strong>{{$data->charge + $data->amount}} {{$gnl->cur}}</strong></li>
                <li class="list-group-item">In USD: <strong>${{$data->usd_amo}}</strong></li>
            </ul>
            <hr>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    Pay Now
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
