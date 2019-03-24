<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/jquery.min.js') }}" defer></script>
        <script src="{{ asset('js/bootstrap.min.js') }}" defer></script>
        <script src="{{ asset('js/jquery.validate.min.js') }}" defer></script>
        <script src="{{ asset('js/additional-methods.min.js') }}" defer></script>
        <script src="{{ asset('js/main.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/main.css') }}" rel="stylesheet">
        
        <!-- Favicon -->
        <link rel="shortcut icon" href="{{ URL::asset('favicon.png') }}">
		<link rel="icon" href="{{ URL::asset('favicon.png') }}" type="image/x-icon">
    </head>
    <body class="pb-5">
        
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container">
                <a class="navbar-brand" href="<?= URL::to('/'); ?>">{{ config('app.name', 'Laravel') }}</a>
                @if (Auth::check())
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                            <a class="nav-item nav-link" href="<?= URL::to('/accounts'); ?>">{{ __('text.accounts') }}</a>
                        </div>
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a href="javascript:void(0)" id="change_lang_us" class="flag-icon <?= ($_COOKIE['locale'] === 'en' ? 'flag-active' : '') ?>" style="text-decoration: none !important;"> <img src="<?= URL::to('/svg/united-states.svg'); ?>"> </a>
                                    <a href="javascript:void(0)" id="change_lang_nl" class="flag-icon <?= ($_COOKIE['locale'] === 'nl' ? 'flag-active' : '') ?>" style="text-decoration: none !important;"> <img src="<?= URL::to('/svg/netherlands.svg'); ?>"> </a>
                                    <a href="javascript:void(0)" id="change_lang_de" class="flag-icon <?= ($_COOKIE['locale'] === 'de' ? 'flag-active' : '') ?>" style="text-decoration: none !important;"> <img src="<?= URL::to('/svg/germany.svg'); ?>"> </a>
                                    
                                    <div class="dropdown-divider"></div>

                                    <a class="dropdown-item" href="<?= URL::to('/profile/'.Auth::user()->id); ?>">{{ __('text.profile') }}</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('text.logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                @else
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a href="javascript:void(0)" id="change_lang_us" class="flag-icon <?= ($_COOKIE['locale'] === 'us' ? 'flag-active' : '') ?>" style="text-decoration: none !important;"> <img src="<?= URL::to('/svg/united-states.svg'); ?>"> </a>
                            <a href="javascript:void(0)" id="change_lang_nl" class="flag-icon <?= ($_COOKIE['locale'] === 'nl' ? 'flag-active' : '') ?>" style="text-decoration: none !important;"> <img src="<?= URL::to('/svg/netherlands.svg'); ?>"> </a>
                            <a href="javascript:void(0)" id="change_lang_de" class="flag-icon <?= ($_COOKIE['locale'] === 'de' ? 'flag-active' : '') ?>" style="text-decoration: none !important;"> <img src="<?= URL::to('/svg/germany.svg'); ?>"> </a>                
                        </li>
                    </ul>
                @endif
            </div>
        </nav>

        @yield('content')

        <input id="correctIBAN" type="hidden" value="{{ __('text.correctIBAN') }}">
        <input id="fieldMandatory" type="hidden" value="{{ __('text.fieldMandatory') }}">
    </body>
</html>
