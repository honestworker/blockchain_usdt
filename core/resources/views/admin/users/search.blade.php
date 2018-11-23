@extends('layouts.admin')
@section('right_action')
<form method="POST" action="{{route('admin.search-users')}}">
    @csrf
    <input type="search" name="search" class="app-search__input" style="background:#ddd;" placeholder="Search">
    <button class="app-search__button" type="submit"> <i class="fa fa-search"></i></button>
</form>
@endsection
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
                    Details
                </th>
            </tr>
        </thead>
        <tbody>
            @if(count($users)==0)
            <tr class="text-center">
                <td colspan="5"><h2>No Result Found</h2></td> 
            </tr>
            @else
            @foreach($users as $user)
            <tr>
                <td>
                    {{$user->name}}
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
                    <a href="{{route('admin.user-single', $user->id)}}" class="btn btn-outline btn-circle btn-sm green">
                        <i class="fa fa-eye"></i> View </a>
                    </td>
                </tr>
                @endforeach 
                @endif
                <tbody>
                </table>
            </div>
            
            
            @endsection