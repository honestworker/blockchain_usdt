@extends('layouts.user')

@section('content')
<h2> BALANCE : <strong>{{round(Auth::user()->balance,$gnl->decimal)}}</strong>  {{$gnl->cur}}</h2>


<div class="card">
    <div class="card-header">
        Deposit Payment Gateway
    </div>
    <div class="card-body">
        <div class="row">                  
            <div class="col-md-6 offset-md-3 col-sm-6 col-xs-12" style="margin-top:10px;">
                <div class="card">
                    <div class="card-header">{{$gate->name}}</div>
                    <div class="card-body">
                        <div class="card">
                            <img src="{{asset('assets/images/gateway')}}/{{$gate->id}}.jpg" style="max-width:200px; max-height:200px; margin:0 auto;"/>
                        </div>
                        <div class="card">
                            <p>Deposit Limit <strong>{{$gnl->cursym}}{{$gate->minamo}} ~ {{$gnl->cursym}}{{$gate->maxamo}}</strong></p>
                            <p>Charge <strong>{{$gnl->cursym}}{{$gate->fixed_charge}} + {{$gate->percent_charge}} %</strong></p>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="#" data-toggle="modal" 
                        data-name="{{$gate->name}}" data-gate="{{$gate->id}}"  
                        data-target="#depoModal" class="btn btn-primary depoButton">
                        Deposit Now</a>
                    </div>
                    
                </div>
            </div>
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
                <form action="{{route('deposit.data-insert')}}" method="POST">
                    @csrf
                    <input type="hidden" name="gateway" id="gateWay"/>
                    <div class="form-group">
                        <h5>Enter Deposit Amount</h5>
                        <div class="input-group-append">
                            <input type="text" name="amount" class="form-control"/>                            
                            
                            <span class="input-group-text">{{$gnl->cursym}}</span>
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-success btn-lg">Deposit Preview</button>
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
        
        $(document).on('click','.depoButton', function(){
            $('#ModalLabel').text($(this).data('name'));
            $('#gateWay').val($(this).data('gate'));
        });
    });
</script>

@endsection



