<?php
    use App\Http\ConvertCurrency;
?>
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
                <div class="col-12 col-lg-6 pt-3">
                    <div class="card mb-3">
                        <div class="card-body">
                            <?php
                                if ( app()->getLocale() === 'us' ) {
                                    // US
                                    $dec_point = ".";
                                    $thousands_sep = ",";

                                    $amount = ConvertCurrency::EURtoUSD($paymentRequest['money_amount']);
                                    $currency = '&dollar;';
                                } else {
                                    // NL & DE
                                    $dec_point = ",";
                                    $thousands_sep = ".";

                                    $amount = $paymentRequest['money_amount'];
                                    $currency = '&euro;';
                                }
                            ?>  
                            <h5 class="card-title">{!! $currency !!}{{ number_format( $amount, 2, $dec_point, $thousands_sep ) }}</h5>
                            <p class="card-text">{{ $paymentRequest['text'] }}</p>
                            <h6 class="card-subtitle mb-2 text-muted">{{ __('payment.toReceiver') }} {{ $receiver }}</h6>
                            <form method="POST" action="<?= URL::to('/paysetup/'.$paymentRequest['id']); ?>">
                                @csrf
                                <!-- <a  href="<?= URL::to('/paysetup/'.$paymentRequest['id']); ?>" class="btn btn-block btn-lg btn-primary mt-4">{{ __('payment.Pay') }}</a> -->
                                <button class="btn btn-block btn-lg btn-primary mt-4" type="submit">
                                    {{ __('payment.Pay') }}
                                </button>

                                <button class="btn btn-link my-3" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                    {{ __('payment.optionalData') }}
                                </button>
                                <div class="collapse" id="collapseExample">
                                    <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-4 col-form-label">{{ __('payment.whoYouAre') }}</label>
                                        <div class="col-sm-8">
                                            <input name="respondername" type="text" class="form-control" placeholder="Jan van Dijk">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-4 col-form-label">{{ __('payment.whereYouAre') }}</label>
                                        <div class="col-1">
                                            <div class="custom-control custom-checkbox">
                                                <input name="loccheckbox" type="checkbox" class="custom-control-input" id="customCheck1">
                                                <label class="custom-control-label" for="customCheck1"></label>
                                            </div>
                                        </div>
                                        <div class="col-11 col-sm-7">
                                            <?php 
                                                // TODO: only for testing (to avoid 127.0.0.1), change when live.
                                                $loc = geoip()->getLocation('213.73.228.52'); 
                                                //$loc = geoip()->getLocation( Request::ip() ); 
                                            ?>
                                            <input type="text" disabled class="form-control" placeholder="{{ $loc['country'] }}, {{ $loc['state_name'] }}, {{ $loc['city'] }}">
                                            <input name="locinfo" type="hidden" value="<?= $loc['ip'] .'|'. $loc['country'] .'|'. $loc['state_name'] .'|'. $loc['city'] .'|'. $loc['lat'] .'|'. $loc['lon'] ?>">
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>