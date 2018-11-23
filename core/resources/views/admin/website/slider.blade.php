@extends('layouts.admin')
@section('page_styles')
<link rel="stylesheet" href="{{asset('assets/admin/css/bootstrap-fileinput.css')}}">
@endsection
@section('right_action')
<button class="btn btn-lg btn-primary" data-toggle="modal" data-target="#newSlider">
        <i class="fa fa-plus"></i> New Slider
    </button>
@endsection
@section('content')
<div class="tile">
    <div class="row">
        @php $sl = 1; @endphp
        @foreach($sliders as $slide)
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-header text-center">
                    Slider No: <strong>{{$sl}}</strong>
                    <button  class="pull-right btn btn-sm btn-danger" data-toggle="modal" data-target="#delModal{{$slide->id}}"><i class="fa fa-trash"></i></button>
                </div>
                <div class="card-body">
                    <form role="form" method="POST" action="{{route('admin.slide-update',$slide->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        
                                <div class="form-group">
                                    <h4>Slider panel-heading</h4>
                                    <input type="text" value="{{$slide->heading}}" class="form-control"  name="heading" >
                                </div>
                          
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-block">Update</button>
                                </div>
                                
                            </form>
                        </div>
                    </div>				
                </div>
                <div id="delModal{{$slide->id}}" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Delete Slider</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                
                            </div>
                            <div class="modal-body">
                                <form role="form" method="POST" action="{{route('admin.slide-delete',$slide)}}" >
                                    @csrf
                                    @method('put')
                                    <button type="submit" class="btn btn-danger btn-block">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @php $sl = $sl+1; @endphp
                @endforeach
            </div>
        </div>
        <div id="newSlider" class="modal fade" role="dialog">
            <div class="modal-dialog">
                
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">New Slider</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        
                    </div>
                    <div class="modal-body">
                        <form role="form" method="POST" action="{{route('admin.slide-store')}}" enctype="multipart/form-data">
                            @csrf
                            
                                <div class="form-group">
                                    <h4>Slider panel-heading</h4>
                                    <input type="text"  class="form-control"  name="heading" >
                                </div>

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