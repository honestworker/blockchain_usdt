@extends('layouts.admin')

@section('content')
<div class="tile">
    <div class="row">
        <div class="col-md-12">
            
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
                    </tr>
                </thead>
                <tbody>
                    @foreach($admins as $user)
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
                    </tr>
                    @endforeach 
                    <tbody>
                    </table>
                </div>
                
            </div>
        </div>
		
        @endsection