@extends('layouts.auth')

@section('content')
<div class="card bg-dark">
    <div class="card-header text-center">
        <h3>{{__('ResetPassword')}}</h3>
        @include('layouts.error') 
    </div>
    <div class="card-body">
        <form  method="POST" action="{{ route('password.sendemail') }}">
            @csrf
            <div class="form-group">
                <input class="form-control" type="email" placeholder="{{__('email')}}" name="email" value="{{ old('email') }}" required>
                
                @if ($errors->has('email'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    {{__('Send')}} {{__('Password')}} {{__('ResetLink')}}
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
