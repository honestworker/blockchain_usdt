@extends('layouts.admin')
@section('content')
<div class="tile">
        <table class="table table-responsive-lg" id="sampleTable">
                <thead>
                    <tr>
                        <th class="text-center">User</th>
                        <th class="text-center">Round</th>
                        <th class="text-center">Team</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Purchase Time</th>
                    </tr>
                </thead>
                
                @foreach($keys as $log)
                <tr>
                <td class="text-center"><a href="{{route('admin.user-single', $log->user->id)}}"> {{$log->user->name}}</a></td>
                    <td class="text-center">{{$log->round->name}}</td>
                    <td class="text-center">{{$log->team->name}}</td>
                    <td class="text-center">{{round($log->price, $gnl->decimal)}} {{$gnl->cur}}</td>
                    <td class="text-center">{{$log->status == 1 ? 'Active' : 'Over'}}</td>
                    <td class="text-center">{{$log->created_at}}</td>
                </tr>
                @endforeach
            </table>
            <div class="text-center">
                {{$keys->links()}}
            </div>
</div>      
@endsection
@section('page_scripts')
<script type="text/javascript" src="{{asset('assets/admin/js/plugins/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/admin/js/plugins/dataTables.bootstrap.min.js')}}"></script>
<script type="text/javascript">$('#sampleTable').DataTable();</script>
@endsection