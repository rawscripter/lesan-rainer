<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Rainer </title>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <link rel="icon" href="{{asset('assets/user/images/icon/Logo Signature.svg')}}">

    <!--======================== fontawsome css======================-->
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.7.2/css/all.css">
    <!--======================== bootstrap css ========================-->
    <link rel="stylesheet" href="//stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <!--======================== main style css ========================-->
    <link rel="stylesheet" href="{{asset('assets/user/css/style.css')}}">
    <!--======================== responsive css ========================-->
    <link rel="stylesheet" href="{{asset('assets/user/css/responsive.css')}}">

    @yield('header')
    <style>
        div#loginModal {
            background: #ffffff14;
            position: absolute;
            padding-top: 200px;
        }

        div#loginModal input {
            margin-top: 15px;
            border-radius: 0px;
            color: #fff;
        }

        div#loginModal input:focus, div#loginModal input:visited {
            background: transparent !important;
        }
    </style>
</head>
<body>

<header class="header_area">

    <div class="menu_area">
        <nav class="navbar navbar-expand-lg navbar-dark" style="background:#4D4D4D;">
            <a class="navbar-brand" href="{{route('site.home')}}"><img style="width: 30%"
                                                                       src="{{asset('assets/user/images/icon/Logo Signature.svg')}}"
                                                                       alt="logo"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            SCULPTURES
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @foreach($collections as $collection)
                                <a class="dropdown-item"
                                   href="{{route('site.collection',$collection->name)}}">{{$collection->name}}</a>
                            @endforeach
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('site.installations')}}">INSTALLATIONS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('about')}}">ABOUT</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('articles')}}">ARTICLES</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('exhibitions')}}">EXHIBITIONS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('contact')}}">CONTACT</a>
                    </li>
                </ul>
                <form class="my-2 my-lg-0 heade-user-button">
                    @guest()
                        <a href="#" style="color: #fff" class="btn btn-default" data-toggle="modal"
                           data-target="#loginModal">
                            <img src="{{asset('assets/user/images/icon/Login Icon.svg')}}" style="width: 13%;" alt="">
                            LOGIN
                        </a>
                    @endguest
                    @auth()
                        <a href="/user/logout" style="color: #fff"
                           class="btn btn-default">Welcome, {{auth()->user()->name}}
                            !
                            <img
                                src="{{asset('assets/user/images/icon/Logout Icon.svg')}}" style="width: 13%;"
                                alt=""></a>
                    @endauth
                </form>
            </div>
        </nav>
    </div>
</header>

@yield('body')

{{--<a href="#" id="scroll" style="display: none;"><span></span></a>--}}


<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body contact_form">
                <h3 class="text-center text-white">Login</h3>
                <form method="POST" id="popupLoginModal" action="{{ route('login') }}" class="pt-3">
                    @csrf
                    <div class="form-group">
                        <input type="email" required
                               class="form-control form-control-lg"
                               id="exampleInputEmail1"
                               placeholder="email"
                               name="email"
                               autocomplete="off"
                        >
                    </div>
                    <div class="form-group">
                        <input type="password" required
                               name="password"
                               class="form-control form-control-lg"
                               id="exampleInputPassword1"
                               autocomplete="off"
                               placeholder="Password">
                    </div>
                    <div class="mt-3">
                        <button type="submit"
                                class="btn btn-block border-0 btn-light btn-lg font-weight-medium auth-form-btn">
                            {{ __('Login') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<footer class="footer_area">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-6">
                <div class="footer_copyrigth_sec">
                    <p>Copyright &copy; <?php echo date('Y'); ?> RainerLagemann.com</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-6">
                <div class="footer_designer_info">
                    <p>Website by <a href="https://tridedesigns.com/" style="color: #c7c7c7;text-decoration: none;">Tride
                            Designs</a></p>
                </div>
            </div>
        </div>
    </div>
</footer>
<script src="//code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="//stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="{{asset('assets/user/js/main.js')}}"></script>
<script src="{{asset('assets/user/js/scroll.js')}}"></script>
@yield('footer')
</body>

</html>
