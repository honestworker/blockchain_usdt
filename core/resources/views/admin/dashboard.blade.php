@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card bg-dark text-white">
            <div class="card-header">STATISTICS</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-lg-3">
                      <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                        <div class="info">
                          <h4>Users</h4>
                          <p><b>{{$users}}</b></p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                      <div class="widget-small info coloured-icon"><i class="icon fa fa-share fa-3x"></i>
                        <div class="info">
                          <h4>Withdraw Req</h4>
                          <p><b>{{$withdraw}}</b></p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                      <div class="widget-small warning coloured-icon"><i class="icon fa fa-plus fa-3x"></i>
                        <div class="info">
                          <h4>Total Deposit</h4>
                          <p><b>{{round($deposit, $gnl->decimal)}}</b> {{$gnl->cur}}</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                      <div class="widget-small info coloured-icon"><i class="icon fa fa-key fa-3x"></i>
                        <div class="info">
                          <h4>Current Round</h4>
                          @if(isset($round))
                          <p><b>{{round($keys, $gnl->decimal)}}</b> {{$gnl->cur}}</p>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
          </div>
    </div>
</div>
<div class="row">
  <div class="col-md-12">
    <hr>
  </div>
  <div class="col-md-12">
      <div class="card bg-dark text-white">
          <div class="card-header">CURRENT ROUND IN EACH TEAM</div>
          <div class="card-body">
              <div class="row">
                  @if(isset($round))
                  @foreach($teams as $team)
                  @php $keyamount = \App\Key::where('round_id', $round->id)->where('team_id', $team->id)->sum('price'); @endphp
                  <div class="col-md-3 col-lg-3">
                    <div class="widget-small primary coloured-icon"><i class="icon fa fa-object-group fa-3x"></i>
                      <div class="info">
                        <h4>{{$team->name}}</h4>
                        <p><b>{{round($keyamount, $gnl->decimal)}} {{$gnl->cur}}</b> </p>
                      </div>
                    </div>
                  </div>
                  @endforeach
                  @endif
                </div>
          </div>
        </div>
  </div>

</div>


@endsection