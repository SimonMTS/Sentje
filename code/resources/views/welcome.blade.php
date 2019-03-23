@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="jumbotron mt-5">
                <h1 class="display-4">Sentje</h1>
                <p class="lead">{{ __('text.welcomeText') }}</p>
                <hr class="my-4">
                <p>{{ __('text.welcomeSubText') }}</p>
                <p class="lead">
                    <a class="btn btn-outline-info btn-lg" href="{{ route('login') }}">{{ __('text.login') }}</a>
                    <a class="btn btn-primary btn-lg" href="{{ route('register') }}">{{ __('text.register') }}</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
