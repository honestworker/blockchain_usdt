@extends('layouts.user')

@section('content')
        <div class="card text-center">
            <h3 style="color: #cc0000;">{{__('Sorry! Page Not Found')}}</h3>
            <h4><a href="{{route('home')}}">{{__('Back To Home')}}</a></h4>
        </div>
@endsection