@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="jumbotron mt-5">
                <h1 class="display-4">Sentje</h1>
                <p class="lead">Met Sentje is geld innen supersimpel. Bijvoorbeeld als je iets hebt voorgeschoten voor je vrienden. Of als je klanten geld naar jouw bedrijf moeten overmaken.</p>
                <hr class="my-4">
                <p>Log hier in, of als je nog geen account hebt meld je makkelijk aan!</p>
                <p class="lead">
                    <a class="btn btn-outline-info btn-lg" href="{{ route('login') }}">Inloggen</a>
                    <a class="btn btn-primary btn-lg" href="{{ route('register') }}">Aanmelden</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
