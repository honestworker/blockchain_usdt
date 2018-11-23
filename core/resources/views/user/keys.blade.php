@extends('layouts.user')

@section('content')
<div class="card bg-dark">
    <div class="card-header text-center">
        <h2>{{__('your')}} {{__('Keys')}}</h2>
    </div>
    <div class="card-body">
        <table class="table table-responsive-lg">
            <thead>
                <tr>
                    <th class="text-center">{{__('round')}}</th>
                    <th class="text-center">{{__('teams')}}</th>
                    <th class="text-center">{{__('price')}}</th>
                    <th class="text-center">{{__('purchasedvia')}}</th>
                    <th class="text-center">{{__('status')}}</th>
                    <th class="text-center">{{__('purchase')}} {{__('time')}}</th>
                </tr>
            </thead>
            <tbody>
                @if(count($keys)==0)
                <tr>
                    <td colspan="6" class="text-center"><h2>No Data Available</h2></td>
                </tr>
                @endif
                @foreach($keys as $log)
                <tr class="{{$log->type == 1 ? 'text-success' : 'text-danger'}}">
                    <td class="text-center">{{$log->round->name}}</td>
                    <td class="text-center">{{$log->team->name}}</td>
                    <td class="text-center">{{round($log->price, $gnl->decimal)}} {{$gnl->cur}}</td>
                    <td class="text-center">{{$log->type == 1 ? 'WALLET PAYMENT' : $gnl->cur.' PAYEMNT'}}</td>
                    <td class="text-center">{{$log->status == 1 ? 'Active' : 'Over'}}</td>
                    <td class="text-center">{{$log->created_at}}</td>
                </tr>
                @endforeach
            </tbody>
            
        </table>
        <div class="text-center">
            {{$keys->links()}}
        </div>
    </div>
</div>
@endsection





