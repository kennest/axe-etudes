<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Axe-Etudes | @yield('title','Accueil')</title>

	<!-- Latest compiled and minified CSS -->
	<link href="/css/bootstrap.css" rel="stylesheet">
	<link href="/font-awesome/css/font-awesome.css" rel="stylesheet">
	<link href="/css/splash.css" rel="stylesheet">
	<link href="/css/style.css" rel="stylesheet">
	<link href="/css/navbar.css" rel="stylesheet">

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="container">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">Axe-Etudes</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li class="active"><a href="#">Link</a></li>
				<li><a href="#">Link</a></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="#">Action</a></li>
						<li><a href="#">Another action</a></li>
						<li><a href="#">Something else here</a></li>
						<li class="divider"></li>
						<li><a href="#">Separated link</a></li>
						<li class="divider"></li>
						<li><a href="#">One more separated link</a></li>
					</ul>
				</li>
			</ul>

			<ul class="nav navbar-nav navbar-right">
			                        <!-- Authentication Links -->
			                        @if (Auth::guard('etablissements')->guest())

			                            <!--Seller Login and registration Links -->

			                            <li><a href="{{ route('dash_login_form') }}">Connexion</a></li>
			                            <li><a href="{{ route('dash_register') }}">S'enregistrer</a></li>
			                        @else
			                            <li class="dropdown">
			                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
			                                    {{ Auth::guard('etablissements')->user()->name }} <span class="caret"></span>
			                                </a>

			                                <ul class="dropdown-menu" role="menu">
			                                    <li>
			                                        <a href="{{ route('dash_logout') }}"
			                                            onclick="event.preventDefault();
			                                                     document.getElementById('logout-form').submit();">
			                                            Logout
			                                        </a>

			                                        <form id="logout-form" action="{{ route('dash_logout') }}" method="POST" style="display: none;">
			                                            {{ csrf_field() }}
			                                        </form>
			                                    </li>
			                                </ul>
			                            </li>
			                        @endif
			                    </ul>
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>

<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
            @include('Guest.include.search')
		</div>
        <p>&nbsp;</p>
		<div class="col-lg-8" id="content">
			@if (Session::has('success'))
				<div class="alert alert-success alert-dissmissible">
					{{Session::get('success')}}
				</div>
			@endif
			@yield('content')
		</div>
		<div class="col-lg-4">
			@yield('sidebar')
			<h1>Sidebar</h1>
		</div>
	</div>
		<!--Loading animation-->
		<div class="bg_load"></div>
		<div class="wrapper">
			<div class="inner">
				<span>L</span>
				<span>o</span>
				<span>a</span>
				<span>d</span>
				<span>i</span>
				<span>n</span>
				<span>g</span>
			</div>
		</div>
		<!--Loading animation-->
</div>

	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
{!! Html::script('js/splash.js') !!}
{!! Html::script('js/navbar.js') !!}
</body>
</html>
