<!DOCTYPE html>
<html lang="xxx">
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/images/logo/icon.png')}}">
    <link rel="icon" type="image/png" href="{{asset('assets/images/logo/icon.png')}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        {{__($gnl->title)}} | {{__($gnl->subtitle)}}
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="{{asset('assets/user/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/user/css/custom.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/user/css/color.php?color=') }}{{$gnl->color}}" rel="stylesheet">
    @yield('styles')
</head>

<body class="bg-dark">
    <div class="container-fluid">
        <div class="col-md-10 offset-md-1 col-sm-12 col-xs-12">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <a class="navbar-brand" href="{{url('/')}}">
                    <img src="{{asset('assets/images/logo/logo.png')}}" alt="logo" style="max-width:160px;">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item {{request()->path() == '/' ? 'active':''}}">
                            <a class="nav-link" href="{{url('/')}}">{{__('Home')}} </a>
                        </li>
                        @auth
                        <li class="nav-item {{request()->path() == 'home/keys' ? 'active':''}}">
                            <a class="nav-link" href="{{route('user.keys')}}">{{__('Keys')}}</a>
                        </li>
                        <li class="nav-item {{request()->path() == 'home/payments' ? 'active':''}}">
                            <a class="nav-link" href="{{route('user.payments')}}">{{__('Payments')}}</a>
                        </li>
                        <li class="nav-item {{request()->path() == 'home/withdraw' ? 'active':''}}">
                            <a class="nav-link" href="{{route('user.withdraw')}}">{{__('Withdraw')}} </a>
                        </li>
                        <li class="nav-item {{request()->path() == 'home/transactions' ? 'active':''}}">
                            <a class="nav-link" href="{{route('user.transactions')}}">{{__('Transactions')}} </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{asset('assets/user/img/anime3.png')}}" style="max-width:20px;">
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a href="{{route('user.profile')}}" class="dropdown-item">{{Auth::user()->name}}</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{__('Logout')}}</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @else
                        <li class="nav-item {{request()->path() == 'login' ? 'active':''}}">
                            <a class="nav-link" href="{{route('login')}}">{{__('Login')}} </a>
                        </li>
                        <li class="nav-item {{request()->path() == 'register' ? 'active':''}}">
                            <a class="nav-link" href="{{route('register')}}">{{__('Register')}} </a>
                        </li>
                        @endauth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{__('Language')}} [ {{session('CurrentLanguage') =='' ? 'en'  : session('CurrentLanguage')}} ]
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a href="{{route('user.language', 'en')}}" class="dropdown-item">English</a>
                                <a href="{{route('user.language', 'ch')}}" class="dropdown-item">Chinese (Simplified)</a>
                                <a href="{{route('user.language', 'tc')}}" class="dropdown-item">Chinese (Traditional)</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="container-fluid mt-5">
                <div class="row">
                    <div class="col-md-6 mx-auto text-center" id="justify-height">
                        @include('layouts.error')
                        @yield('content')
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <footer class="footer mt-3">
                            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                                <a class="navbar-brand" href="#">{{__('Copyright')}} &copy; {{date('Y')}} {{__($gnl->title)}}</a>
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                
                                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                    <ul class="navbar-nav ml-auto">
                                        @if(isset($socials)) 
                                        @foreach ($socials as $item)
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{$item->link}}" target="_blank">{{__($item->icon)}}</a>
                                        </li>
                                        @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </nav>
                        </footer>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    <!--   Core JS Files   -->
    <script src="{{asset('assets/user/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/user/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/user/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/user/js/bootstrap-notify.js')}}"></script>
    <script src="{{asset('assets/user/js/perfect-scrollbar.jquery.min.js')}}"></script>
    <script>
        $(document).ready(function(){
            var winheight = $(window).height() - 220;
            $('#justify-height').css('min-height',winheight+'px');
        });
    </script>
    @include('layouts.message')
    @yield('scripts')
</body>

</html>