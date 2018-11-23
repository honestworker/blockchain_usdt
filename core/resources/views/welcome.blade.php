@extends('layouts.user')
@section('styles')
@include('home.style')
@endsection
@section('content')
<div class="card text-center bg-dark text-white">
    <div class="card-body">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="row">
                    <div class="col-md-4 col-sm-12 mx-auto">
                        <div class="text-center">
                            <h3>{{__('Current Price')}}</h3>
                            <h1>{{round($price,$gnl->decimal)}} {{__($gnl->cur)}}</h1>
                            <h3>{{ __('total') }} : {{round($total,$gnl->decimal)}} {{__($gnl->cur)}}</h3>
                            <h6>{{ __('endin') }}</h6>
                            <div class="card bg-dark card-body">
                                    <h2 id="endinTop">--:--:--</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12">
                        @if(isset($lastWinner))
                        <h3>{{ __('latestwinner')}} <strong>{{$lastWinner->user->email}}</strong> {{ __('got')}} <strong>{{round($lastWinAmount, $gnl->decimal)}}</strong> {{__($gnl->cur)}}</h3>
                        @endif
                        <div class="card card-body bg-dark" data-toggle="modal" data-target="#rulesModal" style="cursor:pointer;">
                            <div id="slideshow">
                                @foreach ($sliders as $item)
                                <div><h5>{{__($item->heading)}}</h5></div>
                                @endforeach
                            </div>
                        </div>
                        <hr>
                        
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mt-5">
            @include('home.left')
            @include('home.right')
        </div>
    </div>
</div>

@include('home.modal')

@endsection
@section('scripts')
@include('home.script')
@auth
<script>
    document.getElementById("copybtn").onclick = function() 
    {
        document.getElementById('rlink').select();
        document.execCommand('copy');
    }
</script>
@endauth
@endsection