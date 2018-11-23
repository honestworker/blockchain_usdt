@extends('layouts.user')
@section('content')
<div class="card">
	<div class="card-header text-center">
		<h3>{{$pt}}</h3>
		@include('layouts.error') 
	</div>
	<div class="card-body text-center">
		<h6> PLEASE SEND EXACTLY <span style="color: green"> {{ $bcoin }}</span> {{$cur}}</h6>
		<h5>TO <span style="color: green"> {{ $wallet}}</span></h5>
		{!! $qrurl !!}
		<h4 style="font-weight:bold;">SCAN TO SEND</h4>						
	</div>
</div>

@endsection