@extends('layouts.auth')

@section('content')
<div class="card bg-dark">
    <div class="card-header"><h2>{{__('Login')}}</h2></div>    
    <div class="card-body">
        
        @include('layouts.error')
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <input type="text" class="form-control" name="username"  placeholder="{{__('username')}}" required />
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password"  placeholder="{{__('Password')}}" required />
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">{{__('Login')}}</button>
            </div>
        </form>
    </div>    
    <div class="card-footer">
        <a class="float-left" href="{{route('register')}}">
            {{__('Register')}}
        </a>
        
        <a class="float-right" href="{{ route('password.resetreq') }}">
            {{__('ForgotPassword')}}?
        </a>
    </div>
</div>
@endsection
