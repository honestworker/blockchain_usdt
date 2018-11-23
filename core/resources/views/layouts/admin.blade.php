<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{$gnl->title}} - Admin</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/logo/icon.png')}}">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/main.css') }}"> @yield('page_styles')
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
@yield('page_styles') 
</head>

<body class="app sidebar-mini rtl">
    <!-- Navbar-->
    <header class="app-header">
        <a class="app-header__logo" href="{{route('admin.dashboard')}}">
            <img src="{{asset('assets/images/logo/logo.png')}}" alt="logo" class="logo-default" style="width: 100px; height: 60px;"> </a>
            <!-- Sidebar toggle button-->
            <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
            <!-- Navbar Right Menu-->
            <ul class="app-nav">
                <!-- User Menu-->
                <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu">
                    <i class="fa fa-user fa-lg"></i> <span>{{Auth::guard('admin')->user()->name}}</span></a>
                    <ul class="dropdown-menu settings-menu dropdown-menu-right">
                        <li><a class="dropdown-item" href="{{route('admin.new-admin')}}"><i class="fa fa-user fa-lg"></i>Create New Admin </a></li>
                        <li><a class="dropdown-item" href="{{route('admin.list-admin')}}"><i class="fa fa-users fa-lg"></i>List of Admin </a></li>
                        <li><a class="dropdown-item" href="{{route('admin.change-password')}}"><i class="fa fa-cog fa-lg"></i> Change Password </a></li>
                        
                        <li>
                            <a class="dropdown-item" href="#" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out fa-lg"></i> Logout
                        </a>
                        
                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
        <ul class="app-menu">
            <li>
                <a class="app-menu__item @if(request()->path() == 'admin/dashboard') active @endif" href="{{route('admin.dashboard')}}">
                    <i class="app-menu__icon fa fa-dashboard"></i>
                    <span class="app-menu__label">Dashboard</span></a>
                </li>
                <li class="treeview @if(request()->path() == 'admin/users') is-expanded
                    @elseif(request()->path() == 'admin/user-search') is-expanded
                    @elseif(request()->path() == 'admin/user-banned') is-expanded
                    @elseif(request()->path() == 'admin/broadcast') is-expanded
                    @elseif(request()->path() == 'admin/subscribers') is-expanded
                    @endif">
                    <a class="app-menu__item" href="#" data-toggle="treeview">
                        <i class="app-menu__icon fa fa-users"></i>
                        <span class="app-menu__label">Manage Users</span>
                        <i class="treeview-indicator fa fa-angle-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a class="treeview-item  @if(request()->path() == 'admin/users') active @endif" href="{{route('admin.users')}}">
                                <i class="icon fa fa-users"></i> All Users
                            </a>
                        </li>
                        <li>
                            <a class="treeview-item @if(request()->path() == 'admin/broadcast') active @endif" href="{{route('admin.broadcast')}}">
                                <i class="icon fa fa-envelope"></i> Broadcast Email
                            </a>
                        </li>
                        <li>
                            <a class="treeview-item @if(request()->path() == 'admin/user-banned') active @endif" href="{{route('admin.user-ban')}}">
                                <i class="icon fa fa-users" style="color:brown;"></i> Banned Users
                            </a>
                        </li>
                        
                    </ul>
                </li>
                <li>
                    <a class="app-menu__item @if(request()->path() == 'admin/round') active @endif" href="{{route('admin.round')}}">
                        <i class="menu__icon fa fa-play"></i> &nbsp; &nbsp;
                        <span class="app-menu__label">Rounds</span>
                    </a>
                </li>
                <li>
                    <a class="app-menu__item @if(request()->path() == 'admin/team') active @endif" href="{{route('admin.team')}}">
                        <i class="menu__icon fa fa-object-group"></i> &nbsp; &nbsp;
                        <span class="app-menu__label">Teams</span>
                    </a>
                </li>
                <li>
                    <a class="app-menu__item @if(request()->path() == 'admin/keys') active @endif" href="{{route('admin.keys')}}">
                        <i class="menu__icon fa fa-key"></i> &nbsp; &nbsp;
                        <span class="app-menu__label">Keys</span>
                    </a>
                </li>
                <li>
                    <a class="app-menu__item @if(request()->path() == 'admin/transactions') active @endif" href="{{route('admin.transactions')}}">
                        <i class="menu__icon fa fa-list"></i> &nbsp; &nbsp;
                        <span class="app-menu__label">Transactions</span>
                    </a>
                </li>
                
                <li class="treeview
                @if(request()->path() == 'admin/deposits')  is-expanded
                @elseif(request()->path() == 'admin/gateway')  is-expanded
                @endif">
                <a class="app-menu__item" href="#" data-toggle="treeview">
                    <i class="app-menu__icon fa fa-plus"></i>
                    <span class="app-menu__label">Deposit</span>
                    <i class="treeview-indicator fa fa-angle-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a class="treeview-item  @if(request()->path() == 'admin/deposits') active @endif" href="{{route('admin.deposits')}}">
                            <i class="icon fa fa-plus"></i> Deposits
                        </a>
                    </li>
                    <li>
                        <a class="treeview-item @if(request()->path() == 'admin/gateway') active @endif" href="{{route('admin.gateway')}}">
                            <i class="icon fa fa-credit-card"></i> Payment Gateway
                        </a>
                    </li>
                </ul>
            </li>
            <li class="treeview
            @if(request()->path() == 'admin/wmethod') is-expanded
            @elseif(request()->path() == 'admin/withdraw-request') is-expanded
            @elseif(request()->path() == 'admin/withdraw-log') is-expanded @endif">
            <a class="app-menu__item" href="#" data-toggle="treeview">
                <i class="app-menu__icon fa fa-share"></i>
                <span class="app-menu__label">Withdraw</span>
                <i class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a class="treeview-item  @if(request()->path() == 'admin/withdraw-request') active @endif" href="{{route('admin.withdraw-request')}}">
                        <i class="icon fa fa-share"></i> Withdraw Request
                    </a>
                </li>
                <li>
                    <a class="treeview-item @if(request()->path() == 'admin/withdraw-log') active @endif" href="{{route('admin.withdraw-log')}}">
                        <i class="icon fa fa-list"></i> Withdraw Log
                    </a>
                </li>
                <li>
                    <a class="treeview-item @if(request()->path() == 'admin/wmethod') active @endif" href="{{route('admin.wmethod')}}">
                        <i class="icon fa fa-credit-card"></i> Withdraw Method
                    </a>
                </li>
            </ul>
        </li>
        <li class="treeview
        @if(request()->path() == 'admin/general') is-expanded
        @elseif(request()->path() == 'admin/logo-icon') is-expanded
        @elseif(request()->path() == 'admin/email-sms') is-expanded @endif">
        <a class="app-menu__item" href="#" data-toggle="treeview">
            <i class="app-menu__icon fa fa-cogs"></i>
            <span class="app-menu__label">Website Control</span>
            <i class="treeview-indicator fa fa-angle-right"></i>
        </a>
        <ul class="treeview-menu">
            <li>
                <a class="treeview-item  @if(request()->path() == 'admin/general') active  @endif " href="{{route('admin.general')}}">
                    <i class="icon fa fa-cog"></i> General Settings
                </a>
            </li>
            <li>
                <a class="treeview-item @if(request()->path() == 'admin/logo-icon') active  @endif" href="{{route('admin.logo')}}">
                    <i class="icon fa fa-picture-o"></i> Logo and Icon
                </a>
            </li>
            <li>
                <a class="treeview-item @if(request()->path() == 'admin/eamil-sms') active @endif" href="{{route('admin.email')}}">
                    <i class="icon fa fa-envelope"></i> Email and SMS
                </a>
            </li>
        </ul>
    </li>
    <li class="treeview
    @if(request()->path() == 'admin/about-section') is-expanded
    @elseif(request()->path() == 'admin/slider-section') is-expanded
    @elseif(request()->path() == 'admin/footer-section') is-expanded
    @elseif(request()->path() == 'admin/social-section') is-expanded
    @endif">
    <a class="app-menu__item" href="#" data-toggle="treeview">
        <i class="app-menu__icon fa fa-globe"></i>
        <span class="app-menu__label">Frontend Content</span>
        <i class="treeview-indicator fa fa-angle-right"></i>
    </a>
    <ul class="treeview-menu">
            <li>
                    <a class="treeview-item  @if(request()->path() == 'admin/about-section') active  @endif " href="{{route('admin.aboutsection')}}">
                        <i class="icon fa fa-cog"></i> About Section
                    </a>
                </li>
            <li>
                    <a class="treeview-item  @if(request()->path() == 'admin/slider-section') active  @endif " href="{{route('admin.slidersection')}}">
                        <i class="icon fa fa-cog"></i>Message Slider
                    </a>
                </li>
        <li>
            <a class="treeview-item  @if(request()->path() == 'admin/social-section') active  @endif " href="{{route('admin.socialsection')}}">
                <i class="icon fa fa-cog"></i> Social Section</a>
            </li>
           
            <li>
                <a class="treeview-item  @if(request()->path() == 'admin/footer-section') active  @endif " href="{{route('admin.footersection')}}">
                    <i class="icon fa fa-cog"></i> Footer Section
                </a>
            </li>
            
        </ul>
    </li>
    <li>
        <a class="app-menu__item @if(request()->path() == 'admin/language') active @endif" href="{{route('admin.language')}}">
            <i class="menu__icon fa fa-flag"></i> &nbsp; &nbsp;
            <span class="app-menu__label">Language</span>
        </a>
    </li>
</ul>
</aside>
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> {{$pt}}</h1>
        </div>
        <div class="app-search">
            @yield('right_action')
        </div>
        
    </div>
    <div class="row">
        <div class="col-md-12">
            @include('layouts.error') 
            @yield('content')
        </div>
    </div>
</main>
<!-- Essential javascripts for application to work-->
<script src="{{asset('assets/admin/js/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('assets/admin/js/popper.min.js')}}"></script>
<script src="{{asset('assets/admin/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/admin/js/main.js')}}"></script>
<!-- The javascript plugin to display page loading on top-->
<script src="{{asset('assets/admin/js/plugins/pace.min.js')}}"></script>
<!-- Page specific javascripts-->
<script src="{{asset('assets/admin/js/plugins/bootstrap-notify.min.js')}}"></script>

@yield('page_scripts') 
@include('layouts.message')
</body>

</html>