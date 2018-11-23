@extends('layouts.user')

@section('content')
<div class="row">
    <div class="col-md-12">
            <div class="card bg-dark  text-white">
                    <div class="card-header text-center"><h3>{{Auth::user()->name}}</h3></div>
                    <div class="card-body">
                        <div class="col-md-6 mx-auto">
                            <form  class="contact-form" method="POST" action="{{ route('user.update-profile') }}">
                                @csrf
                                <div class="form-group">
                                    <label>{{__('fullname')}}</label>
                                    <input class="form-control" type="text" name="name" value="{{$user->name}}" required>
                                </div>
                                <div class="form-group">
                                    <label>{{__('email')}}</label>
                                    <input class="form-control" type="email" name="email" value="{{$user->email}}" required>
                                </div>
                                <div class="form-group">
                                    <label>{{__('mobile')}}</label>
                                    <input class="form-control" type="text" name="mobile" value="{{$user->mobile}}" required>
                                </div>
                                <div class="form-group">
                                    <label>{{__('country')}}</label>
                                    <input class="form-control" type="text" name="country" value="{{$user->country}}" required>
                                </div>
                                <div class="form-group">
                                    <label>{{__('city')}}</label>
                                    <input class="form-control" type="text" name="city" value="{{$user->city}}" required>
                                </div>
                                <div class="form-group text-center">
                                    <hr>
                                    <button type="submit" class="btn btn-primary btn-block">
                                            {{__('Update')}} {{__('Profile')}}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 mt-3">
            <div class="card bg-dark text-white ">
                    <div class="card-header text-center"> <h4>{{__('Change')}} {{__('Password')}}</h4></div>
                    <div class="card-body">
                        <div class="col-md-6 mx-auto">
                            <form  class="contact-form" method="POST" action="{{ route('user.change-passwordpost') }}">
                                @csrf
                                <div class="form-group">
                                    <input class="form-control" id="password" type="password" placeholder="{{__('Password')}}" name="password" required>
                                </div>
                                
                                <div class="form-group">
                                    <input class="form-control" id="password-confirm" type="password" placeholder="{{__('Confirm')}} {{__('Password')}}" name="password_confirmation" required>
                                </div>
                                
                                <div class="form-group text-center">
                                    <hr>
                                    <button type="submit" class="btn btn-primary btn-block">
                                         {{__('Change')}} {{__('Password')}}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
    </div>
</div>



@endsection
