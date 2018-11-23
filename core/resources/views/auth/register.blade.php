@extends('layouts.auth')

@section('content')
<div class="card bg-dark">
    <div class="card-header">
        <h2>{{__('Register')}}</h2>
        @if(isset($reference))
        <h5>{{__('referals')}}: <strong> {{$reference->name}}</strong> | {{__('username')}}: <strong> {{$reference->username}}</strong></h5>
        @endif
    </div>    
    <div class="card-body">
        @include('layouts.error')
        <form method="POST" action="{{ route('register') }}">
            @csrf

            @if(isset($reference))  
            <input type="hidden" name="refer" value="{{$reference}}">
            @endif
            
            <div class="form-group">
              
                <input class="form-control" type="text" name="name"  placeholder="{{__('fullname')}}" required />
            </div>
            <div class="form-group">
                <input class="form-control" type="email" name="email"  placeholder="{{__('email')}}" required />
            </div>
            <div class="form-group">
                <input class="form-control" type="text" name="mobile"  placeholder="{{__('mobile')}}" required />
            </div>
            <div class="form-group">
                <input class="form-control" type="text" name="username"  placeholder="{{__('username')}}" required />
            </div>
            <div class="form-group">
                <input class="form-control" type="password" name="password"  placeholder="{{__('Password')}}" required />
            </div>
            <div class="form-group">
                <input class="form-control" type="password" name="password_confirmation"  placeholder="{{__('Confirm')}} {{__('Password')}}" required />
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-block btn-primary">{{__('Register')}}</button>
            </div>
        </form>
    </div>
    <div class="card-footer">
        <a class="float-left" href="{{route('login')}}">
           {{__('Login')}}
        </a>
        
        <a class="float-right" href="{{ route('password.resetreq') }}">
            {{__('ForgotPassword')}}?
        </a>
    </div>
</div>
    
    @endsection
