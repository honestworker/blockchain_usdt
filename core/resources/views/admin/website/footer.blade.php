@extends('layouts.admin')
@section('page_styles')
<script type="text/javascript" src="{{asset('assets/admin/js/nicEdit-latest.js')}}"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
@endsection
@section('content')
<div class="tile">
    <div class="row">
        <div class="col-md-12">
            
            
            <form role="form" method="POST" action="{{route('admin.footer-update')}}" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group">
                    <h4>Contact Number</h4>
                    <input type="text" value="{{$front->contact_number}}" class="form-control" id="contact_number" name="contact_number" >
                </div>
                <div class="form-group">
                    <h4>Contact Email</h4>
                    <input type="text" value="{{$front->contact_email}}" class="form-control" id="contact_email" name="contact_email" >
                </div>   
                
                <div class="form-group">
                    <h4>Footer Section Content</h4>
                    <textarea class="form-control" id="footer" name="footer" rows="7">
                        {{$front->footer}}
                    </textarea>
                </div>								
                
                
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-block">Update</button>
                </div>
                
            </form>
            
        </div>
        
    </div>
</div>
@endsection
