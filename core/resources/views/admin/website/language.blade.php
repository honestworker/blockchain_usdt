@extends('layouts.admin')
@section('right_action')
<button class="btn btn-circle btn-lg btn-primary" data-toggle="modal" data-target="#newText">
    <i class="fa fa-plus"></i> New Content
</button>
@endsection
@section('content')
<div class="tile">
    <div class="row">
        <table class="table table-hover" id="sampleTable">
            <thead>
                <tr>
                    <th>
                        KEY 
                    </th>
                    <th>
                        ENGLISH 
                    </th>
                    <th>
                        CHINESE (Simplified) 
                    </th>
                    <th>
                        CHINESE (Traditional) 
                    </th>
                    <th>
                        Edit
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($keys as $k)
                <tr>
                    <td>
                        {{$k}} 
                    </td>
                    <td>
                        {{$eng[$k]}} 
                    </td>
                    <td>
                        {{$chin[$k]}} 
                    </td>
                    <td>
                        {{$trad[$k]}} 
                    </td>
                    <td>
                        <div class="btn-group" role="group" >
                            <button class="btn btn-sm btn-info button-update" data-key="{{$k}}" data-eng="{{$eng[$k]}}" data-ch="{{$chin[$k]}}" data-tc="{{$trad[$k]}}" data-toggle="modal" data-target="#updateModal">  
                                <i class="fa fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-danger button-delete" data-key="{{$k}}" data-toggle="modal" data-target="#deleteModal">  
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                        
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div id="newText" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">New Content</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form role="form" method="POST" action="{{route('admin.newlang')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <h4>KEY</h4>
                        <textarea name="key"  class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <h4>English</h4>
                        <textarea name="eng"  class="form-control" rows="3" required></textarea>
                    </div>    
                    <div class="form-group">
                        <h4>Chinese (Simplified)</h4>
                        <textarea name="chs"  class="form-control" rows="3" required></textarea>
                    </div>    
                    <div class="form-group">
                        <h4>Chinese (Traditional)</h4>
                        <textarea name="tch"  class="form-control" rows="3" required></textarea>
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

<div id="updateModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Content</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form role="form" method="POST" action="{{route('admin.updateLang')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <h4>KEY</h4>
                        <textarea name="key" id="langKey"  class="form-control" rows="3" readonly required></textarea>
                    </div>
                    <div class="form-group">
                        <h4>English</h4>
                        <textarea name="eng" id="langEng"  class="form-control" rows="3" required></textarea>
                    </div>    
                    <div class="form-group">
                        <h4>Chinese (Simplified)</h4>
                        <textarea name="chs" id="langCh"  class="form-control" rows="3" required></textarea>
                    </div>    
                    <div class="form-group">
                        <h4>Chinese (Traditional)</h4>
                        <textarea name="tch" id="langTc"  class="form-control" rows="3" required></textarea>
                    </div>    
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-block">Update</button>
                    </div>
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div id="deleteModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete Content</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form role="form" method="POST" action="{{route('admin.deleteLang')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <h4>DELETE THIS KEY</h4>
                        <textarea name="key" id="deleteKey"  class="form-control" rows="3" readonly></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-danger btn-block">Delete</button>
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
<script type="text/javascript" src="{{asset('assets/admin/js/plugins/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/admin/js/plugins/dataTables.bootstrap.min.js')}}"></script>
<script type="text/javascript">$('#sampleTable').DataTable();</script>
<script>
    $(document).ready(function(){
        $(document).on('click','.button-update', function(){
            $('#langKey').val($(this).data('key'));
            $('#langEng').val($(this).data('eng'));
            $('#langCh').val($(this).data('ch'));
            $('#langTc').val($(this).data('tc'));
        });
        $(document).on('click','.button-delete', function(){
            $('#deleteKey').val($(this).data('key'));
        });
    });
</script>
@endsection
