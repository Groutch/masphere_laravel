<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'MA Sphere') }}</title>

	<!-- Styles -->
	@yield('css')
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
	
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">
	<link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
	<div id="bg"></div>
	<div id="app">
		<nav class="navbar navbar-default navbar-static-top">
			<div class="container">
				<div class="navbar-header">

					<!-- Collapsed Hamburger -->
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
						<span class="sr-only">Toggle Navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>

					<!-- Branding Image -->
					<a class="navbar-brand" href="{{ url('/') }}">
						<img src="" class="logomasphere" alt="">
						{{-- {{ config('app.name', 'Laravel') }} --}}
					</a>
				</div>

				<div class="collapse navbar-collapse" id="app-navbar-collapse">
					<!-- Left Side Of Navbar -->
					<ul class="nav navbar-nav">
						&nbsp;
					</ul>

					<!-- Right Side Of Navbar -->
					<ul class="nav navbar-nav navbar-right">
						<!-- Authentication Links -->
						@guest
						<li><a href="{{ route('login') }}"><span class="fa fa-sign-in"></span> Login</a></li>
						<li><a href="{{ route('register') }}">Register</a></li>
						@else
                        {{-- <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li> --}}
                        <li>    
                        	<a href="{{ route('logout') }}"
                        	onclick="event.preventDefault();
                        	document.getElementById('logout-form').submit();"
							id="logoutlink" 
                        	>
                        	{{ Auth::user()->name }} Logout <span class="fa fa-sign-in"></span> </a>

                        	<form id="logout-form" action="{{ route('logout') }}" method="POST" hidden>
                        		{{ csrf_field() }}
                        	</form>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
        
    </div>

    @guest
    @else
    <div class="container-bottom">
    	<div class="search-button">
    		@if(Auth::user()->roles->implode('slug') == 'orga')
    			<a id="create" class="linkmenu" href="{{ route('event_form') }}">
    			<i class="fa fa-plus fa-2x" aria-hidden="true"></i>
    			<p class="textmenu">Créer un event</p>
    		</a>
    		@else
    			<a id="search" class="linkmenu" href="/event_search">
    			<i class="fa fa-search fa-2x" aria-hidden="true"></i>
    			<p class="textmenu">Rechercher</p>
    		</a>
    		@endif
    	</div>
    	<div class="dashboard-button">
    		<a id="dashboard" class="linkmenu" href="/event_list_{{ Auth::user()->roles->implode('slug') }}">
    			<i class="fa fa-list fa-2x" aria-hidden="true"></i>
    			<p class="textmenu">Mes évènements</p>
    		</a>
    	</div>
		<!-- bouton d'affichage de son propre profil doublon avec les infos dans evenements -->
    	<!-- <div class="dispo-page">
    		<a id="profil" class="linkmenu" href="/profil/{{Auth::user()->id}}">
    			<i class="fa fa-user fa-2x" aria-hidden="true"></i>
    			@if(Auth::user()->roles->implode('slug') == 'orga')
    			<p class="textmenu">Profil Organisateur</p>
    			@else
    			<p class="textmenu">Mon Profil</p>
    			@endif
    		</a>
    	</div> -->
		<div class="search-button">
			<a id="create" class="linkmenu" href="/map_test">
    			<i class="fa fa-globe fa-2x" aria-hidden="true"></i>
    			<p class="textmenu">Map des events</p>
			</a>
		</div>
    </div>
    @endguest

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/randbackground.js') }}"></script>
    @yield('js')
</body>
</html>
