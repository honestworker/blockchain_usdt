@extends('layouts.admin')

@section('content')
<div class="tile">
    <form role="form" method="POST" action="{{route('admin.broadcast-email')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-body">
            <div class="form-group">
                <label>Subject</label>
                <input type="text" name="subject" class="form-control input-lg" value="">
            </div>
            <div class="form-group">
                <label>Email Message</label>
                <textarea class="form-control" name="emailMessage" rows="10">
                    
                </textarea>
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" class="submit-btn btn btn-primary btn-lg btn-block login-button">Broadcast Email</button>
        </div>
    </form>
</div>

@endsection