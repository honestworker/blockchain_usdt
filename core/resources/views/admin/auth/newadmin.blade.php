@extends('layouts.admin')

@section('content')
<div class="tile">
        <div class="row">
<div class="col-md-12">
                 <form  method="POST" action="{{ route('admin.create-admin') }}">
                   @csrf
                <div class="form-group" >
                    <label>Name of Admin</label>
                   <input id="name" type="text" class="form-control" name="name">
                </div>
                <div class="form-group" >
                    <label>Email of Admin</label>
                   <input id="email" type="email" class="form-control" name="email">
                </div>
                <div class="form-group" >
                    <label>Username of Admin</label>
                   <input id="username" type="text" class="form-control" name="username">
                </div>
                <div class="form-group" >
                    <label>New Password</label>
                   <input id="password" type="password" class="form-control" name="password" >
                </div>
                <div class="form-group" >
                    <label>Confirm Password</label>
                   <input id="password-confirm" type="password" class="form-control" name="password_confirmation" >
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-lg btn-block btn-success">Create Admin</button>
                </div>
                
            </form>
          </div>
			
				</div>
			</div>
	
@endsection