@extends('layouts.auth')

@section('content')
<div class="card bg-dark">
    <div class="card-header text-center">
        <h3>{{__('ResetPassword')}}</h3>
        @include('layouts.error') 
    </div>
    <div class="card-body">
        <form  method="POST" action="{{ route('password.resetpassword') }}">
            @csrf
            
            <input type="hidden" value="{{$token}}" name="token" />
            <div class="form-group">
                <input class="form-control" id="username" type="text" value="{{ $username }}" readonly />
            </div>
            <div class="form-group">
                <input class="form-control" id="password" type="password" placeholder="{{__('Password')}}" name="password" required>
                
            </div>
            
            <div class="form-group">
                <input class="form-control" id="password-confirm" type="password" placeholder="{{__('Confirm')}} {{__('Password')}}" name="password_confirmation" required>
            </div>
            
            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary">
                    {{__('ResetPassword')}}
                </button>
            </div>
            
        </form>
    </div>
</div>
@endsection
