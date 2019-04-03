@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <a class="btn btn-outline-primary mt-3 float-right" href="<?= URL::to('/'); ?>"><i class="fas fa-chevron-left"></i> {{ __('text.back') }}</a>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 col-md-6 pt-3">
            
            <div class="card mb-3">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2 text-muted float-right">{{ date( __('text.date_format'), strtotime($request['created_at']) ) }}</h6>
                    <h5 class="card-title">{{ $request['text'] }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">&euro; {{ number_format( $request['money_amount'], 2 ) }}</h6>
                    <p class="card-text text-muted">{{ decrypt($account['IBAN']) }}</p>
                    <p class="card-text">{{ $request['completed_payments'] }}/{{ $request['possible_payments'] }} {{ __('text.paid') }}</p>
                </div>
                <ul class="list-group list-group-flush">
                    @foreach ($responses as $response)
                        <li class="list-group-item">
                            <span class="card-text">
                                #{{ $loop->index + 1 }} 
                            </span>

                            @if( $response['name'] != 'unknown' )
                                <span class="card-text ml-2">
                                    {{ $response['name'] }}
                                </span>
                            @endif

                            @if( json_decode($response['location_info']) != 'unknown' )
                                <span class="card-text ml-2">
                                    {{ json_decode($response['location_info'])[1] }}/{{ json_decode($response['location_info'])[3] }}
                                </span>
                            @endif

                            <span class="float-right text-muted font-weight-bold">
                                {{ date( 'd/m H:i', strtotime($response['updated_at'])) }}
                            </span>

                        </li>
                    @endforeach
                </ul>
                <div class="card-footer text-muted">
                    <?= URL::to('/pay/' . $request['id']); ?>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
