@extends('layouts.auth')

@section('content')
<div class="card bg-dark">
    @if(Auth::user()->status!=1)
    
    <div class="card-header text-center">
        <h2 style="color:red;">Account Deactivated</h2>
    </div>
    
    
    @elseif(Auth::user()->emailv!=1)
    
    <div class="card-header text-center">
        Email Verification
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('user.send-vcode') }}">
            @csrf
            <input class="form-control" id="email" type="hidden"  name="email" value="{{Auth::user()->email}}">
            <h4 class="text-center">Your Email:<strong> {{Auth::user()->email}}</strong> </h4>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Send Verification Code</button>
            </div>
        </form>
        <hr/>
        <form method="POST" action="{{ route('user.email-verify') }}">
            @csrf
            @include('layouts.error') 
            <div class="form-group">
                <input class="form-control" name="code" type="text" placeholder="Enter Verification Code"  required autofocus>
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Submit</button>
            </div>
        </form>
    </div>
    @elseif(Auth::user()->smsv!=1)
    
    <div class="card-header text-center">
        Mobile Number Verification
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('user.send-vcode') }}">
            @csrf
            <input class="form-control" type="hidden"  name="mobile" value="{{Auth::user()->email}}">
            <h4 class="text-center">Your Mobile No:<strong> {{Auth::user()->mobile}}</strong> </h4>
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Send Verification Code</button>
            </div>
        </form>
        <hr/>
        <form method="POST" action="{{ route('user.sms-verify') }}">
            @csrf
            @include('layouts.error') 
            <div class="form-group">
                <input class="form-control" name="code" type="text" placeholder="Enter Verification Code"  required autofocus>
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Submit</button>
            </div>
        </form>
    </div>
    @endif
</div>



@endsection
