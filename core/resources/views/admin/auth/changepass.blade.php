@extends('layouts.admin')

@section('content')
<div class="tile">
    <div class="row">
        <div class="col-md-12">
            
            <form role="form" method="POST" action="{{ route('admin.password-update') }}">
                @csrf
                <div class="form-group" >
                    <label class="control-label visible-ie8 visible-ie9">Old Password</label>
                    <input id="passwordold" type="password" class="form-control form-control-solid placeholder-no-fix" name="passwordold" placeholder="Old Password">
                </div>
                <div class="form-group" >
                    <label class="control-label visible-ie8 visible-ie9">New Password</label>
                    <input id="password" type="password" class="form-control form-control-solid placeholder-no-fix" name="password" placeholder="New Password">
                </div>
                <div class="form-group" >
                    <label class="control-label visible-ie8 visible-ie9">Confirm Password</label>
                    <input id="password-confirm" type="password" class="form-control form-control-solid placeholder-no-fix" name="password_confirmation" placeholder="Confirm Password">
                </div>
                
                <div class="form-actions">
                    <button type="submit" class="btn btn-success btn-block">Change Password</button>
                </div>
                
            </form>
        </div>
        
    </div>
</div>

@endsection