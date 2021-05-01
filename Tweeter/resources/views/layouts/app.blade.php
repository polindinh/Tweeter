<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Tweeter</title>

    <!-- Scripts -->
    <script src="js/app.js" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="{{ mix('css/app.css') }}">



    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm ps sticky-top ">

            <div class="container">
                    <a  href="/home"><img src="/storage/profile_images/Logo.png" style="width:60px; height:50px;" alt="Image"></a>
                    {{-- <a  href="/home"><img src="/storage/profile_images/Logo.png/" style="width:60px; height:50px;" alt="Image"></a> --}}



                {{-- <a class="navbar-brand" href="{{ url('/home') }}" style="color:#1DA1F2">
                    TWEETER
                </a> --}}
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    {{-- <form action="/users" method="get" class="navbar-nav ml-auto"> --}}
                        {{-- @csrf --}}
                        {{-- <a href="/users"  type="submit" style="margin-left:20px">All Users</a> --}}
                        @guest
                        @else
                        <div class="form-group shadow-textarea ">
                            <form action="/tweets/addTweet" method="post"class="navbar-nav ml-auto mt-4">
                                @csrf
                                <input type="hidden" name="user_id" value= {{Auth::user()->id}}>
                                <input class="btn btn-primary rounded-pill m-1 " type="submit" name="submit" value="Tweet" >
                                <input id="field" class="form-control form-control-md rounded-pill border border-primary m-1 "  rows="4" cols="93" type="text" name="content" value="{{old('content')}}" placeholder="What's on your mind?" ></input>
                            </form>
                        </div>
                        @endguest
                        {{-- <div class="content">

                            <div class="title m-b-lg text-center" style="font-size:75px; color:#1DA1F2;">
                                Tweeter
                            </div>
                        </div> --}}



                        {{-- <a class="img-fluid rounded mx-auto d-block" href="{{ url('/home') }}"><img src="{{asset('/storage/profile_images/logotweeter.png/')}}" alt="Image"></a> --}}

                    {{-- </form> --}}
                    <!-- Left Side Of Navbar -->
                    {{-- <ul class="navbar-nav mr-auto">
                        <li><a href="/home">Home</a></li>
                        <li><a href="/about">About</a></li>
                    </ul> --}}

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link " href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else


                            <li class="nav-item dropdown mt-4">

                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-danger" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    {{-- <a class="dropdown-item" href="/profile"> Profile</a> --}}
                                    <a class="dropdown-item text-danger" href="/profile/{{Auth::user()->id}}"
                                    onclick="event.preventDefault();
                                                  document.getElementById('profile-form').submit();">
                                     {{ __('Profile') }}
                                 </a>
                                 <form id="profile-form" action="/profile/{{Auth::user()->id}}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                    <a class="dropdown-item text-danger" href="/users"  type="submit">All Users</a>

                                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
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


        <main class="py-1">
            @yield('content')
        </main>
    </div>
</body>
</html>
