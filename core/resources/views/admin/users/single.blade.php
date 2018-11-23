@extends('layouts.admin')

@section('content')
<div class="tile">
  <div class="row">
    <div class="col-md-4">
      <p>Email: <strong>{{ $user->name }}</strong></p> 
      <p>Username: <b>{{ $user->username }}</b></p>
    </div>
    <div class="col-md-4 offset-md-4">
      <div class="widget-small primary coloured-icon"><i class="icon fa fa-money fa-3x"></i>
        <div class="info">
          <h4>BALANCE</h4>
          <p><b>{{round($user->balance, $gnl->decimal)}} {{$gnl->cursym}}</b></p>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="tile">
  <div class="row">
    <div class="col-md-6">
      <a href="{{route('admin.user-email',$user->id)}}" class="btn btn-lg btn-block btn-primary" style="margin-bottom:10px;">Send Email</a>
    </div>
    <div class="col-md-6"> 
      <button type="button" class="btn btn-warning btn-lg btn-block" data-toggle="modal" data-target="#changepass">Change Password</button>        
    </div>
  </div> 
</div>

<div class="tile">
  <h3 class="tile-title">Update Profile</h3>
  <div class="tile-body">
    <form id="form" method="POST" action="{{route('admin.user-status', $user->id)}}" enctype="multipart/form-data">
      @csrf
      @method('put')
      <div class="row">
        <div class="form-group col-md-4">
          <label>Users Name</label>
          <input type="text" name="name" class="form-control" value="{{$user->name}}">
        </div>
        <div class="form-group col-md-4">
          <label>Phone</label>
          <input type="text" name="mobile" class="form-control" value="{{$user->mobile}}">
        </div>
        <div class="form-group col-md-4">
          <label>Email</label>
          <input type="email" name="email" class="form-control" value="{{$user->email}}">
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-3">
          <label>User Status</label>
          <div class="toggle lg">
              <label>
                <input type="checkbox"value="1" name="status" {{ $user->status == "1" ? 'checked' : '' }}><span class="button-indecator"></span>
              </label>
            </div>
        </div> 
        <div class="form-group col-md-3">
          <label>Google Authentication</label>
          <div class="toggle lg">
            <label>
              <input type="checkbox" value="1" name="tauth" {{ $user->tauth == "1" ? 'checked' : '' }}><span class="button-indecator"></span>
            </label>
          </div>
        </div> 
        <div class="form-group col-md-3">
          <label>Email Verification</label>
          <div class="toggle lg">
            <label>
              <input type="checkbox" value="1" name="emailv" {{ $user->emailv == "1" ? 'checked' : '' }}><span class="button-indecator"></span>
            </label>
          </div>
        </div>   
        <div class="form-group col-md-3">
          <label>SMS Verification</label>
          <div class="toggle lg">
            <label>
              <input type="checkbox" value="1" name="smsv" {{ $user->smsv == "1" ? 'checked' : '' }}><span class="button-indecator"></span>
            </label>
          </div>
        </div> 
      </div>
      <div class="row">
        <button type="submit" class="btn btn-lg btn-primary btn-block">Update</button>
      </div>     
    </form>
  </div>
</div>
</div>



<!--Change Pass Modal -->
<div id="changepass" class="modal fade" role="dialog">
  <div class="modal-dialog">
    
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title pull-left">Change Password</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form role="form" method="POST" action="{{route('admin.user-pass', $user->id)}}" enctype="multipart/form-data">
          @csrf
          @method('put')
          <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password" class="col-md-4 control-label">Password</label>
            
            
            <input id="password" type="password" class="form-control" name="password" required>
            
            @if ($errors->has('password'))
            <span class="help-block">
              <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
            
          </div>
          
          <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
            
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
            
            @if ($errors->has('password_confirmation'))
            <span class="help-block">
              <strong>{{ $errors->first('password_confirmation') }}</strong>
            </span>
            @endif
            
          </div>
          
          <div class="form-group">
            
            <button type="submit" class="btn btn-primary btn-block">
              Change Password
            </button>
          </div>
        </form>
      </div>
      
    </div>
    
  </div>
</div>
@endsection


