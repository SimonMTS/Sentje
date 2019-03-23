@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <a class="btn btn-success btn-lg mt-3 float-right" href="<?= URL::to('/payment'); ?>">Sentjes aanvragen</a>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-6 pt-3">

            <div class="card mb-3">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2 text-muted float-right">23/03/2019</h6>
                    <h5 class="card-title">Voor de film</h5>
                    <h6 class="card-subtitle mb-2 text-muted">$10,50</h6>
                    <p class="card-text">0/3 betaald</p>
                    <a href="#" class="card-link">Details</a>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2 text-muted float-right">Datum</h6>
                    <h5 class="card-title">Jouw tekst</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Hoeveelheid geld</h6>
                    <p class="card-text">Aantal betaald</p>
                    <a href="#" class="card-link">Details</a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
