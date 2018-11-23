@extends('layouts.admin')
@section('page_styles')
<link rel="stylesheet" href="{{asset('assets/admin/css/bootstrap-fileinput.css')}}">
@endsection

@section('content')
<div class="tile">
    <div class="row">
        <div class="col-md-6 offset-md-3" style="margin-top:10px;">
            <div class="card text-white bg-dark">
                <div class="card-header text-center">
                    {{$gateway->main_name}}
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('admin.gateup', $gateway)}}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group text-center">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="width: 150px; height: 150px;">
                                    <img src="{{ asset('assets/images/gateway') }}/{{$gateway->id}}.jpg" alt="*" /> 
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 150px; max-height: 150px;"> 
                                </div>
                                <div>
                                    <span class="btn btn-success btn-file">
                                        <span class="fileinput-new"> Change Logo </span>
                                        <span class="fileinput-exists"> Change </span>
                                        <input type="file" name="gateimg"> 
                                    </span>
                                    <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="status">Currency</label>
                            <select class="form-control" name="status">
                                <option value="USDT" {{ $gateway->status == "USDT" ? 'selected' : '' }}>USDT</option>
                                <option value="BTC" {{ $gateway->status == "BTC" ? 'selected' : '' }}>BTC</option>
                                <option value="ETH" {{ $gateway->status == "ETH" ? 'selected' : '' }}>ETH</option>
                                <option value="BCH" {{ $gateway->status == "BCH" ? 'selected' : '' }}>BCH</option>
                                <option value="DASH" {{ $gateway->status == "DASH" ? 'selected' : '' }}>DASH</option>
                                <option value="DOGE" {{ $gateway->status == "DOGE" ? 'selected' : '' }}>DOGE</option>
                                <option value="LTC" {{ $gateway->status == "LTC" ? 'selected' : '' }}>LTC</option>
                            </select>
                        </div>
                        
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
                        <div class="form-group">
                            <label for="val1">Public  KEY</label>
                            <input type="text" value="{{$gateway->val1}}" class="form-control" id="val1" name="val1" >
                        </div>
                        <div class="form-group">
                            <label for="val2">Private KEY</label>
                            <input type="text" value="{{$gateway->val2}}" class="form-control" id="val2" name="val2" >
                        </div>
                        <hr/>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-block">Update</button>
                        </div>
                    </form>
                </div>
            </div>				
        </div>   
    </div>
</div>
@endsection

@section('page_scripts')
<script src="{{asset('assets/admin/js/bootstrap-fileinput.js')}}"></script>
@endsection