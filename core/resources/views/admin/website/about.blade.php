@extends('layouts.admin')
@section('page_styles')
<link rel="stylesheet" href="{{asset('assets/admin/css/bootstrap-fileinput.css')}}">
<script type="text/javascript" src="{{asset('assets/admin/js/nicEdit-latest.js')}}"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
@endsection
@section('content')
<div class="tile">
    <div class="row">
        <div class="col-md-12">
            <form role="form" method="POST" action="{{route('admin.about-update')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <h4>Game Heading</h4>
                    <input type="text" value="{{$front->about_heading}}" class="form-control" id="about_heading" name="about_heading" >
                </div>
                <div class="form-group">
                    <h4>Game Details</h4>
                    <textarea class="form-control" id="about_details" name="about_details" rows="7">
                        {{$front->about_details}}
                    </textarea>
                </div>
              
                <div class="row">
                    <div class="col-md-6">
                            <div class="form-group">
                                    <h4>Video URL</h4>
                                    <input type="text" value="{{$front->video}}" class="form-control" id="video" name="video" >
                                </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <h4>Game Image</h4>
                            <hr>
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail">
                                    <img src="{{ asset('assets/images/frontend') }}/{{$front->about_image}}" alt="" style="max-width:200px;" /> </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail"> </div>
                                    <hr>
                                    <div>
                                        <span class="btn btn-success btn-file">
                                            <span class="fileinput-new"> Change About Image </span>
                                            <span class="fileinput-exists"> Change </span>
                                            <input type="file" name="about_image"> </span>
                                            <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                        </div>
                                    </div>
                                </div>
                    </div>
                </div>
                
                        
                        
                        
                        <div class="form-group">
                            <hr>
                            <button type="submit" class="btn btn-success btn-block">Update</button>
                        </div>
                        
                    </form>
                </div>
            </div>
            
        </div>
        
        @endsection
        
        @section('page_scripts')
        <script src="{{asset('assets/admin/js/bootstrap-fileinput.js')}}"></script>
        @endsection