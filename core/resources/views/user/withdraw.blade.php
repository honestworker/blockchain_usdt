@extends('layouts.user')

@section('content')
<div class="card bg-dark text-center">
    <div class="card-header">
            <h2>{{__('Withdraw')}} {{__('Gateway')}}</h2>
    </div>
    <div class="card-body">
        <div class="row">    
            <div class="col-md-12">
                    <h4> {{__('balance')}} : <strong>{{round(Auth::user()->balance,$gnl->decimal)}}</strong>  {{__($gnl->cur)}}</h4>
                    <hr>    
            </div>              
            @foreach($gates as $gate)
            <div class="col-md-4 col-sm-6 col-xs-12" style="margin-top:10px;">
                <div class="card bg-dark text-white">
                    <div class="card-header">{{__($gate->name)}}</div>
                    <div class="card-body">
                        <div class="card bg-dark text-white">
                            <h5>{{__('Details')}}</h5>
                        <p>{{__($gate->val1)}}</p>
                        <hr>
                            <p>{{__('Withdraw')}} {{__('Limit')}}  <strong>{{$gate->minamo}} {{__($gnl->cur)}} ~ {{$gate->maxamo}} {{__($gnl->cur)}}</strong></p>
                            <p>{{__('charge')}} <strong>{{$gate->fixed_charge}} {{__($gnl->cur)}} + {{$gate->percent_charge}} %</strong></p>
                        </div>
                    </div>
                    <div class="card-footer">
                            <a href="#" data-toggle="modal" 
                            data-name="{{$gate->name}}" data-gate="{{$gate->id}}"  
                            data-target="#depoModal" class="btn btn-block btn-primary withdrawButton">
                            {{__('Withdraw')}}
                        </a>
                    </div>
            </div>
            </div>
            @endforeach
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="depoModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-center">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('withdraw.post')}}" method="POST">
                    @csrf
                    <input type="hidden" name="gateway" id="gateWay"/>
                    <div class="form-group">
                        <label>{{__('Withdraw')}} {{__('amount')}}</label>
                        <div class="input-group-append">
                            <input type="text" name="amount" class="form-control"/>                            
                            <span class="input-group-text">{{__($gnl->cur)}}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label> {{__('Account')}} {{__('Details')}}</label>
                        <input type="text" name="account" class="form-control"/>    
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-success btn-lg"> {{__('Confirm')}} {{__('Withdraw')}}</button>
                    </div>
                    
                </form>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


@endsection
@section('scripts')
<script>
    $(document).ready(function(){
        
        $(document).on('click','.withdrawButton', function(){
            console.log($(this).data('name'))
            $('#ModalLabel').text($(this).data('name'));
            $('#gateWay').val($(this).data('gate'));
        });
    });
</script>

@endsection



