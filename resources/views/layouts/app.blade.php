<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? \App\About::find(1)->title ?? env('APP_NAME', 'The CMS') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/floating-labels.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-tagsinput.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.5.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/apps.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.css" rel="stylesheet">
    {{-- <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.css'> --}}
    <link href="{{ asset('css/chosen.css') }}" rel="stylesheet">


    <style>

    .bootstrap-tagsinput {
        width: 100%;
    }

        .content-section {
  min-height: 2000px;
}
.sidebar-section {
  position: absolute;
  height: 100%;
  width: 100%;
}


.sidebar-item {
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;

	/* Position the items */
	&:nth-child(2) { top: 25%; }
	&:nth-child(3) { top: 50%; }
	&:nth-child(4) { top: 75%; }
}


.make-me-sticky {
  position: -webkit-sticky;
	position: sticky;
	top: 0;

  padding: 0 15px;
}



/* Ignore This, just coloring */
/* body {
  background: #fff;
} */

article {
  background: #f1f1f1;
  border-radius: 12px;
  padding: 25px 0 600px;
}


.title-section, .content-section, .sidebar-section {
  background: #fff;
  border-radius: 12px;
  border: solid 10px #f1f1f1;
}

.title-section {
  /* text-align: center; */
  padding: 50px 15px;
  margin-bottom: 30px;
}

.content-section h2 {
  /* text-align: center; */
  margin: 0;
  padding-top: 200px;
}

.sidebar-item {
  /* text-align: center; */

  h3 {
    background: gold;
    max-width: 100%;
    margin: 0 auto;
    padding: 50px 0 100px;
    border-bottom: solid 1px #fff;
  }
}

.table-links {
  color: #34395e;
  font-size: 12px;
  margin-top: 5px;
  opacity: 0;
  transition: all .3s; }
  .table-links a {
    color: #666; }

table tr:hover .table-links {
  opacity: 1; }

  .bullet, .slash {
  display: inline;
  margin: 0 4px; }

.bullet:after {
  content: '\2022'; }

.slash:after {
  content: '/'; }
</style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Homepage
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="{{ asset('js/bootstrap-tagsinput.min.js') }}"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.jquery.js'></script>
    <script  src="{{ asset('js/chosen.js') }}"></script>

@stack('script')
</body>
</html>
