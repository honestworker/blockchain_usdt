@extends('layouts.admin')

@section('content')
<div class="tile">
        <table class="table table-hover">
                <thead>
                    <tr>
                        <th>
                            Name 
                        </th>
                        <th>
                            Email
                        </th>
                        <th>
                            Username
                        </th>
                        <th>
                             Phone
                        </th>
                       	<th>
                       		Balance
                       	</th>                       	
                        <th>
                            Details
                        </th>
                  	 </tr>
                </thead>
                <tbody>
		 	@foreach($users as $user)
                     <tr>
                     	<td>
                                <a href="{{route('admin.user-single', $user->id)}}">{{$user->name}}</a>
                        </td>
                        <td>
                            {{$user->email}}      
                        </td> 
                        <td>
                            {{$user->username}}      
                        </td>
                        <td>
                            {{$user->mobile}}
                        </td>
                        <td>
                        	{{round($user->balance, $gnl->decimal)}} {{$gnl->cursym}}
                        </td>
                        <td>
                        	<a href="{{route('admin.user-single', $user->id)}}" class="btn btn-sm">
                             <i class="fa fa-eye"></i> View </a>
                        </td>
                     </tr>
 			@endforeach 
 			<tbody>
           </table>
            {{$users->links()}}
        </div>
			
@endsection