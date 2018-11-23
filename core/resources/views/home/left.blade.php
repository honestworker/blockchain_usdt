<div class="col-md-6 col-sm-12 col-xs-12">
    <hr>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="purchase-tab" data-toggle="tab" href="#purchase" role="tab" aria-controls="purchase" aria-selected="true">{{__('purchase')}}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">{{__('Vault')}}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="referal-tab" data-toggle="tab" href="#referal" role="tab" aria-controls="referal" aria-selected="false">{{__('referals')}}</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="purchase" role="tabpanel" aria-labelledby="purchase-tab">
            <div class="card bg-dark">
                <div class="card-header">{{__('KEYRING')}}</div>
                <div class="card-body">
                    <p> {{__('Purchases of 1')}} {{__($gnl->cur)}} {{__('or more have a 0.3% chance to win some of the')}} {{round($round->winner*$total/100,$gnl->decimal)}}% {{__('ETH airdrop pot, instantly')}}!</p>
                    <hr>
                    <form id="purchaseForm">
                        @csrf 
                        <input type="hidden" name="team" id="teamSlectedID">
                        <div class="form-group">
                            <div class="input-group-append">
                                <input type="number" name="amount" value="1" placeholder="ENTER KEY AMOUNT" class="form-control" id="keyAmount">
                                <span class="input-group-text">{{__('Keys')}}  @  <strong id="keyPrice">{{round($price,8)}}</strong>  {{__($gnl->cur)}} </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <button class="btn btn-warning btn-block" type="button" id="oneButton">+1</button>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <button class="btn btn-warning btn-block" type="button" id="twoButton">+2</button>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <button class="btn btn-warning btn-block" type="button" id="fiveButton">+5</button>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <button class="btn btn-warning btn-block" type="button" id="tenButton">+10</button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <hr>
                            </div>
                            @foreach ($teams as $item)
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="card bg-dark selectedTeam" data-team="{{$item->id}}" style="cursor:pointer;">
                                    <div class="card-header">{{__($item->name)}}</div>
                                    <div class="card-body">
                                        <img src="{{asset('assets/images/team')}}/{{$item->image}}" style="width:100%" alt="team">
                                        <hr>
                                        <p>{{__($item->details)}}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <hr>
                                <h1><i class="fas fa-spinner" id="delaySpiner" style="display:none;"></i></h1>
                            </div>
                            @auth
                            <div class="col-md-6">
                                <div class="form-group">
                                    <button class="btn btn-primary btn-block" type="button" id="sendButton">{{__('Send')}} {{__($gnl->cur)}}</button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <button class="btn btn-secondary btn-block" type="button" data-toggle="modal" data-target="#vaultModal"> {{__('Use')}} {{__('Vault')}}</button>
                                </div>
                            </div>
                            @else
                            <div class="col-md-8 offset-md-2">
                                <a class="btn btn-success btn-block" href="{{route('login')}}"> {{__('Please Login to Purchase')}}</a>
                            </div>
                            @endif
                        </div>
                    </form>
                    
                    <div class="card bg-dark" id="depositCard" style="display:none;">
                        <div class="card-header">
                            <h4>{{__('Send')}} <strong id="sendAmount"></strong> {{__($gnl->cur)}} {{__('TO THIS ADDRESS WITHIN 3 HOURS')}}</h4>
                        </div>
                        <div class="card-body">
                            <h3 id="depositAddress"></h3>
                            <hr>
                            <img id="depositQRCode" style='width:300px; filter: invert(100%);' />
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="card bg-dark">
                <div class="card-header">{{__('Vault')}}</div>
                <div class="card-body">
                    <h3>{{__('TOTAL EARNINGS')}} : <strong>{{Auth::check() ? round(Auth::user()->balance,$gnl->decimal) : 0.000}}</strong> {{__($gnl->cur)}}</h3>
                </div>
                <div class="card-footer">
                    <a href="{{route('user.withdraw')}}" class="btn btn-warning btn-block">{{__('Withdraw')}}</a>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="referal" role="tabpanel" aria-labelledby="referal-tab">
            <div class="card bg-dark">
                <div class="card-header">{{__('referals')}}</div>
                <div class="card-body">
                    @auth
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card bg-dark">
                                <div class="card-header">
                                        {{__('referals')}} {{__('URL')}}
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <div class="input-group-append">
                                            <input type="text" class="form-control input-lg" id="rlink" value="{{url('/')}}/register/{{Auth::user()->username}}" readonly>
                                            <span class="input-group-text" id="copybtn" style="cursor:pointer;">{{__('Copy')}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-responsive-lg">
                                <thead>
                                    <tr>
                                        <th>{{__('username')}}</th>
                                        <th>{{__('fullname')}}</th>
                                        <th>{{__('joiningdate')}}</th>
                                        <th>{{__('purchase')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($refers as $ref)
                                    <tr>
                                        <td>{{$ref->username}}</td>
                                        <td>{{$ref->name}}</td>
                                        <td>{{$ref->created_at}}</td>
                                        @php $keys = \App\Key::where('round_id',$round->id)->where('user_id',$ref->id)->sum('price'); @endphp
                                        <td>{{round($keys,$gnl->decimal)}} {{__($gnl->cur)}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> 
                    </div>
                    @else
                    <h3>{{__('please')}} <a href="{{route('login')}}">{{__('Login')}}</a> {{__('first')}}</h3>
                    @endauth
                </div>
                
            </div>
        </div>
    </div>
</div>