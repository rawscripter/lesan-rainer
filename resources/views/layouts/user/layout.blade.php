<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Rainer </title>
	<meta name="csrf-token" content="{{ csrf_token() }}"/>
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
						<a class="nav-link" href="{{route('contact')}}">CONTACT</a>
					</li>
				</ul>
				
				<form class="my-2 my-lg-0 heade-user-button">
					@guest()
						<a href="/login" style="color: #fff" class="btn btn-default">
							<img src="{{asset('assets/user/images/icon/Login Icon.svg')}}" style="width: 13%;" alt="">
							LOGIN
						</a>
					@endguest
					@auth()
						<a href="/admin" style="color: #fff" class="btn btn-default">Welcom, {{auth()->user()->name}}! <img
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
