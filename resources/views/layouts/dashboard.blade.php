<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Laravel</title>

    <!-- Styles -->
    @vite(['resources/js/app.js']);

</head>

<body>
    <div>
        <div id="sidebar"></div>
        <div id="content">
        <header>
            
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                        <div class="container">
                            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                                <div class="logo_laravel">
                                    <svg viewBox="0 0 651 192" fill="none" xmlns="http://www.w3.org/2000/svg" style"width: 150px">
                                        <g clip-path="url(#clip0)" fill="#EF3B2D">
                                            <path d="M248.032 44.676h-16.466v100.23h47.394v-14.748h-30.928V44.676zM337.091 87.202c-2.101-3.341-5.083"></path>
                                        </g> 
                                    </svg>
                                </div>
                            </a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
            
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav me-auto">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{url('/') }}">{{ __('Home') }}</a>
                                    </li>
                                </ul>  
                                <ul class="navbar-nav ml-auto">
                                    @guest
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('login')}}">{{ __('Login') }}</a>
                                    </li>
                                    @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('register')}}">{{ __('Register') }}</a>
                                    </li>
                                    @endif
                                    @else
                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown=" data-bs-toggle="dropdown">
                                            {{ Auth::user()->name }}
                                        </a>
            
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{url('dashboard') }}">{{__('Dashboard') }}</a>
                                            <a class="dropdown-item" href="{{url('profile') }}">{{__('Profile') }}</a>
                                            <a class="dropdown-item" href="{{route('logout') }}" onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();">
                                                
                                                {{__('Logout') }}
                                            </a>
            
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </div>
                                    </li>
                                    @endguest
                                </ul> 
                            </div> 
                        </div>
            </nav>
        </header>
        <main>
                
        </main>
    </div>
</body>
</html>