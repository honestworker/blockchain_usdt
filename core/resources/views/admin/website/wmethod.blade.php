@extends('layouts.admin')
@section('page_styles')
<link rel="stylesheet" href="{{asset('assets/admin/css/bootstrap-fileinput.css')}}">
@endsection
@section('right_action')
<button class="btn btn-circle btn-lg btn-primary" data-toggle="modal" data-target="#newMethod">
    <i class="fa fa-plus"></i> New Method
</button>
@endsection
@section('content')
<div class="tile">
    <div class="row">
        @foreach($gateways as $gateway)
        <div class="col-md-4" style="margin-top:10px;">
            <div class="card text-white {{$gateway->status==1?'bg-dark':'bg-secondary'}}">
                <div class="card-header text-center">
                    {{$gateway->name}}
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('admin.wmethod-update', $gateway)}}" enctype="multipart/form-data">
                        @csrf()
                        @method('put')
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" name="status">
                                <option value="1" {{ $gateway->status == "1" ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $gateway->status == "0" ? 'selected' : '' }}>Deactive</option>
                            </select>
                        </div>
                        <button class="btn btn-info btn-block btn-sm" type="button" data-toggle="collapse" data-target="#collapseExample{{$gateway->id}}" aria-expanded="false" aria-controls="collapseExample">
                            <i class="fa fa-eye"></i> DETAILS
                        </button>
                        <div class="collapse" id="collapseExample{{$gateway->id}}">
                            <hr/>
                            <div class="form-group">
                                <label>Name of Gateway</label>
                                <input type="text" value="{{$gateway->name}}" class="form-control" id="name" name="name" >
                            </div>
                            <div class="form-group">
                                <label>Rate</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            1 USD =
                                        </span>
                                    </div>
                                    <input type="text" value="{{$gateway->rate}}" class="form-control" id="rate" name="rate" >
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            {{ $gnl->cur }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <hr/>
                            <div class="card text-center text-dark">
                                <div class="card-header">
                                    Withdraw Limit
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="minamo">Minimum Amount</label>
                                                <div class="input-group">
                                                    <input type="text" value="{{$gateway->minamo}}" class="form-control" id="minamo" name="minamo" >
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            {{ $gnl->cur }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="maxamo">Maximum Amount</label>
                                                <div class="input-group">
                                                    <input type="text" value="{{$gateway->maxamo}}" class="form-control" id="maxamo" name="maxamo" >
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            {{ $gnl->cur }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr/>
                            <div class="card text-center text-dark">
                                <div class="card-header">
                                    Withdraw Charge
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="chargefx">Fixed Charge</label>
                                                <div class="input-group">
                                                    <input type="text" value="{{$gateway->fixed_charge}}" class="form-control" id="chargefx" name="fixed_charge" >
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            {{ $gnl->cur }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="chargepc">Charge in Percentage</label>
                                                <div class="input-group">
                                                    <input type="text" value="{{$gateway->percent_charge}}" class="form-control" id="chargepc" name="percent_charge" >
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            {{ $gnl->cur }}
                                                        </span>
                                                    </div>
                                                </div>   
                                            </div>
                                        </div>
                                    </div>                                                            
                                </div>
                            </div>
                            <hr/>
                          
                            <div class="form-group">
                                <label for="val1"><strong>Method Details</strong></label>
                                <input type="text" value="{{$gateway->val1}}" class="form-control" id="val1" name="val1" >
                            </div>
                        </div>
                        
                        <hr/>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-block">Update</button>
                        </div>
                    </form>
                </div>
            </div>				
        </div>   
        @endforeach
    </div>
</div>

<div id="newMethod" class="modal fade" role="dialog">
        <div class="modal-dialog">
            
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">New Withdraw</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    
                </div>
                <div class="modal-body">
                        <form method="post" action="{{route('admin.wmethod-create')}}" enctype="multipart/form-data">
                            @csrf()
                    
                                <div class="form-group">
                                    <label>Name of Gateway</label>
                                    <input type="text" class="form-control" id="name" name="name" >
                                </div>
                                <div class="form-group">
                                    <label>Rate</label>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                1 USD =
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" id="rate" name="rate" >
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                {{ $gnl->cur }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <hr/>
                                <div class="card text-center text-dark">
                                    <div class="card-header">
                                        Withdraw Limit
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="minamo">Minimum Amount</label>
                                                    <div class="input-group">
                                                        <input type="text"  class="form-control" id="minamo" name="minamo" >
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">
                                                                {{ $gnl->cur }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="maxamo">Maximum Amount</label>
                                                    <div class="input-group">
                                                        <input type="text"  class="form-control" id="maxamo" name="maxamo" >
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">
                                                                {{ $gnl->cur }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr/>
                                <div class="card text-center text-dark">
                                    <div class="card-header">
                                        Withdraw Charge
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="chargefx">Fixed Charge</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="chargefx" name="fixed_charge" >
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">
                                                                {{ $gnl->cur }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="chargepc">Charge in Percentage</label>
                                                    <div class="input-group">
                                                        <input type="text"  class="form-control" id="chargepc" name="percent_charge" >
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">
                                                                {{ $gnl->cur }}
                                                            </span>
                                                        </div>
                                                    </div>   
                                                </div>
                                            </div>
                                        </div>                                                            
                                    </div>
                                </div>
                                <hr/>
                              
                                <div class="form-group">
                                    <label for="val1"><strong>Method Details</strong></label>
                                    <input type="text" class="form-control" id="val1" name="val1" >
                                </div>
                                <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control" name="status">
                                            <option value="1">Active</option>
                                            <option value="0">Deactive</option>
                                        </select>
                                    </div>

                            
                            <hr/>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block">Create</button>
                            </div>
                        </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                </div>
            </div>
            
        </div>
    </div>
@endsection

@section('page_scripts')
<script src="{{asset('assets/admin/js/bootstrap-fileinput.js')}}"></script>
@endsection