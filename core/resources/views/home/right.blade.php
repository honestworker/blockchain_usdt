<div class="col-md-6 col-sm-12 col-xs-12">
    <hr>
    <ul class="nav nav-tabs" id="myTabTwo" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="round-tab" data-toggle="tab" href="#round" role="tab" aria-controls="round" aria-selected="true">{{__('round')}}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="team-tab" data-toggle="tab" href="#team" role="tab" aria-controls="team" aria-selected="true">{{__('teams')}}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="latest-tab" data-toggle="tab" href="#latest" role="tab" aria-controls="latest" aria-selected="true">{{__('latest')}} {{__('Keys')}}</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContentTwo">
        <div class="tab-pane fade show active" id="round" role="tabpanel" aria-labelledby="round-tab">
            <div class="card bg-dark">
                <div class="card-header">
                    <h3>{{__($round->name)}}</h3>
                    <h5>{{__('round')}} {{__('closedin')}}</h5>
                    <h2 id="endinBottom">--:--:--</h2>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td>{{__('activepot')}}</td>
                            <td><strong>{{round($total,$gnl->decimal)}}</strong> {{__($gnl->cur)}}</td>
                        </tr>
                        <tr>
                            <td>{{__('your')}} {{__('Keys')}}</td>
                            <td><strong>{{Auth::check() ? round($mykey,$gnl->decimal) : 0}}</strong> {{__($gnl->cur)}}</td>
                        </tr>
                        <tr>
                            <td>{{__('your')}} {{__('earnings')}}</td>
                            <td><strong>{{Auth::check() ? round(Auth::user()->balance,$gnl->decimal) : 0.000}}</strong> {{__($gnl->cur)}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="team" role="tabpanel" aria-labelledby="team-tab">
            <div class="card bg-dark">
                <div class="card-header">{{__('round')}}</div>
                <div class="card-body">
                    <div class="row">
                        @foreach ($teams as $item)
                        @php 
                        $amount = \App\Key::where('round_id', $round->id)->where('team_id', $item->id)->sum('price');
                        @endphp
                        <div class="col-md-6 mt-2">
                            <div class="card bg-dark">
                                <div class="card-header">{{__($item->name)}}</div>
                                <div class="card-header">
                                    <img src="{{asset('assets/images/team')}}/{{$item->image}}" class="img-responsive" alt="team">
                                    <hr>
                                    <h3>{{round($amount, $gnl->decimal)}} {{__($gnl->cur)}}</h3>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="latest" role="tabpanel" aria-labelledby="latest-tab">
            <div class="card bg-dark">
                <div class="card-header">{{__('latest')}} {{__('Keys')}}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-responsive-lg">
                                <thead>
                                    <tr>
                                        <th class="text-center">{{__('user')}}</th>
                                        <th class="text-center">{{__('round')}}</th>
                                        <th class="text-center">{{__('teams')}}</th>
                                        <th class="text-center">{{__('price')}}</th>
                                        <th class="text-center">{{__('Using')}}</th>
                                        <th class="text-center">{{__('status')}}</th>
                                        <th class="text-center">{{__('time')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @if(count($latestkyes)==0)
                                    <tr>
                                        <td colspan="7" class="text-center"><h2>No Data Available</h2></td>
                                    </tr>
                                    @endif
                                    @foreach($latestkyes as $log)
                                    <tr>
                                        <td class="text-center">{{$log->user->name}}</td>
                                        <td class="text-center">{{$log->round->name}}</td>
                                        <td class="text-center">{{$log->team->name}}</td>
                                        <td class="text-center">{{round($log->price, $gnl->decimal)}} {{__($gnl->cur)}}</td>
                                        <td class="text-center">{{$log->type == 1 ? 'VAULT' : 'PAYEMNT'}}</td>
                                        <td class="text-center">{{$log->status == 1 ? 'Active' : 'Over'}}</td>
                                        <td class="text-center">{{$log->created_at}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>