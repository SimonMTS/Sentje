@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col pt-5">

            <h1 class="display-4 mb-5">{{ __('payment.newSentje') }}</h1>

            <form method="POST" action="<?= URL::to('/payment'); ?>">
                @csrf

                <div class="form-group row">
                    <div class="col-lg-4 col-md-5">
                        <label>{{ __('payment.sentjeText') }}</label>
                        <input name="text" type="text" class="form-control" placeholder="{{ __('payment.sentjeTextExample') }}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-4 col-md-5">
                        <label>{{ __('payment.sentjePrice') }}</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    &euro;
                                </span>
                            </div>
                            <input name="money_amount" type="number" class="form-control" placeholder="{{ __('payment.sentjePriceExample') }}" required>
                        </div>
                    </div>
                </div>
                

                <div class="form-group row">
                    <div class="col-lg-4 col-md-5">
                        <label>{{ __('payment.sentjePossiblePayments') }}</label>
                        <input name="possible_payments" type="number" class="form-control" placeholder="{{ __('payment.sentjePossiblePaymentsExample') }}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-4 col-md-5">
                        <label>{{ __('payment.sentjeNote') }}</label>
                        <input name="text" type="text" class="form-control" placeholder="{{ __('payment.sentjeNoteExample') }}" required>
                    </div>
                </div>
                
                <div class="form-group row">
                    <div class="input-group col-lg-4 col-md-5">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">{{ __('payment.sentjeUpload') }}</span>
                        </div>
                        <div class="custom-file">
                            <input name="image" type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" placeholder="{{ __('payment.sentjeChooseImage') }}"   >
                            <label class="custom-file-label" for="inputGroupFile01">{{ __('payment.sentjeChooseImage') }}</label>
                        </div>
                    </div>
                </div>
                    
                <button type="submit" class="btn btn-success">{{ __('payment.requestSentje') }}</button>
                
            </form>
        </div>
    </div>
</div>
@endsection