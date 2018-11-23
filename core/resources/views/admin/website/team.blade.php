@extends('layouts.admin')
@section('page_styles')
<link rel="stylesheet" href="{{asset('assets/admin/css/bootstrap-fileinput.css')}}">
@endsection
@section('right_action')
<button class="btn btn-circle btn-lg btn-primary" data-toggle="modal" data-target="#newModal">
    <i class="fa fa-plus"></i> New Team
</button>
@endsection
@section('content')
<div class="tile">
    <div class="row">
        @foreach($teams as $team)
        <div class="col-md-3" style="margin-top:10px;">
            <div class="card text-white {{$team->status==1?'bg-dark':'bg-secondary'}}">
                <div class="card-header text-center">
                    {{$team->name}}
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('admin.team-update', $team)}}" enctype="multipart/form-data">
                        @csrf()
                        @method('put')
                        
                        <div class="form-group text-center">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail">
                                    <img src="{{ asset('assets/images/team') }}/{{$team->image}}" style="100%;" alt="*" /> 
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 150px; max-height: 150px;"> 
                                </div>
                                <div>
                                    <span class="btn btn-success btn-file">
                                        <span class="fileinput-new"> Change Logo </span>
                                        <span class="fileinput-exists"> Change </span>
                                        <input type="file" name="image"> 
                                    </span>
                                    <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <label>Name of team</label>
                            <input type="text" value="{{$team->name}}" class="form-control" id="name" name="name" >
                        </div>
                        <div class="form-group">
                            <label>Bonus Amount</label>
                            <div class="input-group-append">
                                <input type="text" value="{{$team->amount}}" class="form-control" id="amount" name="amount" >
                                <span class="input-group-text">
                                    %
                                </span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="details"><strong>Team Details</strong></label>
                            <input type="text" value="{{$team->details}}" class="form-control" id="details" name="details" >
                        </div>
                        
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" name="status">
                                <option value="1" {{ $team->status == "1" ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $team->status == "0" ? 'selected' : '' }}>Deactive</option>
                            </select>
                        </div>
                        
                        <hr/>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-block">Update</button>
                        </div>
                    </form>
                </div>
            </div>				
        </div>   
        @endforeach
    </div>
</div>

<div id="newModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">New Team</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('admin.team-create')}}" enctype="multipart/form-data">
                    @csrf()
                    
                    <div class="form-group text-center">
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 150px; max-height: 150px;"> 
                            </div>
                            <div>
                                <span class="btn btn-success btn-file">
                                    <span class="fileinput-new"> Change Logo </span>
                                    <span class="fileinput-exists"> Change </span>
                                    <input type="file" name="image"> 
                                </span>
                                <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Name of team</label>
                        <input type="text"  class="form-control" id="name" name="name" >
                    </div>
                    <div class="form-group">
                        <label>Bonus Amount</label>
                        <div class="input-group-append">
                            <input type="text"  class="form-control" id="amount" name="amount" >
                            <span class="input-group-text">
                                %
                            </span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="details"><strong>Team Details</strong></label>
                        <input type="text" class="form-control" id="details" name="details" >
                    </div>
                    
                    
                    <hr/>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-block">Create</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page_scripts')
<script src="{{asset('assets/admin/js/bootstrap-fileinput.js')}}"></script>
@endsection