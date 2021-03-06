@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            @if( session('success') !== null )
                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                    <strong>{{ session('success')[0] }}</strong>{{ session('success')[1] }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                    </button>
                </div>
            @endif
            
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
                        <?php
                            if ( app()->getLocale() === 'us' ) {
                                $dec_point = ".";
                                $thousands_sep = ",";
                                $dateFormat = 'm/d/Y';
                            } else {
                                $dec_point = ",";
                                $thousands_sep = ".";
                                $dateFormat = 'd/m/Y';
                            }
                        ?>  
                        <h6 class="card-subtitle mb-2 text-muted">&euro; {{ number_format( $request['money_amount'], 2, $dec_point, $thousands_sep ) }}</h6>
                        @if($request['possible_payments'] === 0)
                            <p class="card-text">{{ $request['completed_payments'] }} {{ __('text.paid') }}</p>
                        @else
                            <p class="card-text">{{ $request['completed_payments'] }}/{{ $request['possible_payments'] }} {{ __('text.paid') }}</p>
                        @endif
                        <a href="<?= URL::to('/payment/view/' . $request['id']); ?>" class="card-link">{{ __('text.details') }}</a>
                        
                        @if($request['completed_payments'] === 0)
                            <a href="javascript:void(0)" class="text-danger float-right" data-toggle="modal" data-target="#deleteModal">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                            <!-- Modal -->
                            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">{{ __('payment.paymentRequestDelete') }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                        {{ __('payment.uSureDeleteRequest') }}<br>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-link" data-dismiss="modal">{{ __('text.noNevermind') }}</button>
                                            <button type="button" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('delete-account-form{{ $loop->index + 1 }}').submit();">{{ __('text.yesDelete') }}</button>
                                            <form id="delete-account-form{{ $loop->index + 1 }}" action="<?= URL::to('/payment/delete/' . $request['id']); ?>" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="card-footer {{ (strtotime( $request['activation_date']) > strtotime('now') ? 'text-danger font-weight-bold':'') }} ">
                        <span id="copy-input{{ $loop->index }}" style="line-height: 37px;"><?= URL::to('/pay/' . $request['id']); ?></span>
                        @if (strtotime( $request['activation_date']) > strtotime('now'))
                            <span class="float-right text-muted font-weight-normal" style="line-height: 37px;">{{ __('payment.availableAfter') }} {{ date($dateFormat, strtotime( $request['activation_date'])) }} </span>
                        @else
                            <button class="btn btn-secondary float-right copy-button" type="button"
                                data-toggle="tooltip" data-placement="top" title="{{ __('text.copyTip') }}"
                                data-input="copy-input{{ $loop->index }}"
                            >
                                <i class="fas fa-copy"></i>
                            </button>
                        @endif
                    </div>
                </div>

            @endforeach
            
            <input type="hidden" id="copy-msg" value="{{ __('text.copyMsg') }}">
        </div>
    </div>
</div>
@endsection
