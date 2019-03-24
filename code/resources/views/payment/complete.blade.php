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
    <body class="pb-5 bg-success">
        
        <nav class="navbar navbar-expand-lg navbar-dark bg-success">
            <div class="container">
                <a class="navbar-brand" href="<?= URL::to('/'); ?>">{{ config('app.name', 'Laravel') }}</a>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a href="javascript:void(0)" id="change_lang_us" class="flag-icon <?= ($_COOKIE['locale'] === 'us' ? 'flag-active' : '') ?>" style="text-decoration: none !important;"> <img src="<?= URL::to('/svg/united-states.svg'); ?>"> </a>
                        <a href="javascript:void(0)" id="change_lang_nl" class="flag-icon <?= ($_COOKIE['locale'] === 'nl' ? 'flag-active' : '') ?>" style="text-decoration: none !important;"> <img src="<?= URL::to('/svg/netherlands.svg'); ?>"> </a>
                        <a href="javascript:void(0)" id="change_lang_de" class="flag-icon <?= ($_COOKIE['locale'] === 'de' ? 'flag-active' : '') ?>" style="text-decoration: none !important;"> <img src="<?= URL::to('/svg/germany.svg'); ?>"> </a>                
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6 pt-3">
                    <div class="card mb-3">
                        <div class="card-body">
                            <?php
                                if ( app()->getLocale() === 'us' ) {
                                    $dec_point = ".";
                                    $thousands_sep = ",";
                                } else {
                                    $dec_point = ",";
                                    $thousands_sep = ".";
                                }
                            ?>  
                            <h5 class="card-title">&euro; {{ number_format( $paymentRequest['money_amount'], 2, $dec_point, $thousands_sep ) }}</h5>
                            <p class="card-text">{{ $paymentRequest['text'] }}</p>
                            <h6 class="card-subtitle mb-2 text-muted">{{ __('payment.toReceiver') }} {{ $receiver }}</h6>
                            <p class="card-text">{{ __('payment.closePage') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>