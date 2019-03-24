@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <a class="btn btn-success btn-lg mt-3 float-right" href="<?= URL::to('/payment'); ?>">{{ __('text.requestSentje') }}</a>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 col-md-6 pt-3">

            @foreach ($requests as $request)
            
                <div class="card mb-3">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-muted float-right">{{ date( __('text.date_format'), strtotime($request['created_at']) ) }}</h6>
                        <h5 class="card-title">{{ $request['text'] }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">&euro; {{ number_format( $request['money_amount'], 2 ) }}</h6>
                        <p class="card-text">{{ $request['completed_payments'] }}/{{ $request['possible_payments'] }} {{ __('text.paid') }}</p>
                        <a href="#" class="card-link">{{ __('text.details') }}</a>
                    </div>
                </div>

            @endforeach

        </div>
    </div>
</div>
@endsection
