@extends('layouts.user')
@section('content')
<div class="card bg-dark text-center">
    <div class="card-header">
        {{__($gnl->title)}}
    </div>
    <div class="card-body">
        <h1>{{__('NO ROUND AVAILABLE NOW')}}</h1>
    </div>
</div>
@endsection