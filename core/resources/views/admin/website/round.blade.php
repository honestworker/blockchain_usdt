@extends('layouts.admin')
@section('right_action')
<button class="btn btn-circle btn-lg btn-primary" data-toggle="modal" data-target="#newModal">
    <i class="fa fa-plus"></i> New Round
</button>
@endsection
@section('content')
<div class="tile">
    <div class="row">
        @foreach($rounds as $round)
        <div class="col-md-4" style="margin-top:10px;">
            <div class="card text-white {{$round->status==1?'bg-secondary' : 'bg-dark'}}">
                <div class="card-header text-center">
                    {{$round->name}}
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('admin.round-update', $round)}}">
                        @csrf
                        @method('put')
                        
                        <div class="form-group">
                            <label>Name of Round</label>
                            <input type="text" value="{{$round->name}}" class="form-control" id="name" name="name" >
                        </div>
                        <div class="form-group">
                            <label>Base Price</label>
                            <div class="input-group-append">
                                <input type="text" value="{{$round->base_price}}" class="form-control" id="base_price" name="base_price" >
                                <span class="input-group-text">{{ $gnl->cur }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inc_rate"><strong>Price Increment Rate</strong></label>
                            <div class="input-group-append">
                                <input type="text" value="{{$round->inc_rate}}" class="form-control" id="inc_rate" name="inc_rate" >
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="winner"><strong>Winner Will Get</strong></label>
                            <div class="input-group-append">
                                <input type="text" value="{{$round->winner}}" class="form-control" id="winner" name="winner" >
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="endin"><strong>Round End After Last Purchase</strong></label>
                            <div class="input-group-append">
                                <input type="text" value="{{$round->endin}}" class="form-control" id="endin" name="endin" >
                                <span class="input-group-text">Hours</span>
                            </div>
                        </div>
                        <hr/>
                       @if($round->status==1)
                       <div class="form-group text-center">
                       <h2>ROUND OVER</h2>
                       </div>
                      @else
                      <div class="form-group">
                            <button type="submit" class="btn btn-success btn-block">Update</button>
                        </div>
                    @endif
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
                <h4 class="modal-title">New Round</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('admin.round-create')}}">
                    @csrf
                    
                    <div class="form-group">
                            <label>Name of Round</label>
                            <input type="text"  class="form-control" id="name" name="name" >
                        </div>
                        <div class="form-group">
                            <label>Base Price</label>
                            <div class="input-group-append">
                                <input type="text"  class="form-control" id="base_price" name="base_price" >
                                <span class="input-group-text">{{ $gnl->cur }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inc_rate"><strong>Price Increment Rate</strong></label>
                            <div class="input-group-append">
                                <input type="text"  class="form-control" id="inc_rate" name="inc_rate" >
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="winner"><strong>Winner Will Get</strong></label>
                            <div class="input-group-append">
                                <input type="text" class="form-control" id="winner" name="winner" >
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="endin"><strong>Round End After Last Purchase</strong></label>
                            <div class="input-group-append">
                                <input type="text" class="form-control" id="endin" name="endin" >
                                <span class="input-group-text">Hours</span>
                            </div>
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
