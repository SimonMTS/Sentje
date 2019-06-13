@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col pt-5">

            <h1 class="display-4 mb-5">{{ __('payment.newSentje') }}</h1>

            <form method="POST" action="<?= URL::to('/payment'); ?>" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group row">
                    <div class="col-lg-4 col-md-5">
                    <label>{{ __('payment.sentjeSelectBankAccount') }} *</label>
                        <select name="IBAN" class="browser-default custom-select" required> 
                            @foreach ($accounts as $account)
                                <option value="{{ $account['id'] }}">{{ decrypt($account['IBAN']) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-4 col-md-5">
                        <label>{{ __('payment.sentjeText') }} *</label>
                        <input name="text" type="text" class="form-control" placeholder="{{ __('payment.sentjeTextExample') }}" max="200" required>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-4 col-md-5">
                        <label>{{ __('payment.sentjePrice') }} *</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <select class="custom-select rounded-0 rounded-left" name="currency">
                                    <option value="euro"> &euro; Euro </option>
                                    <option value="dollar"> &dollar; Dollar </option>
                                </select>
                            </div>
                            <input name="money_amount" type="number" class="form-control" placeholder="{{ __('payment.sentjePriceExample') }}" min="0.01" step="0.01" required>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-4 col-md-5">
                        <label>{{ __('payment.sentjePossiblePayments') }} *</label>
                        <input name="possible_payments" type="number" class="form-control" placeholder="{{ __('payment.sentjePossiblePaymentsExample') }}" min="0" required>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-4 col-md-5">
                        <hr class="mb-0">
                        <small class="text-muted">{{ __('payment.sentjeOptional') }}</small>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-4 col-md-5 mt-2">
                        <label>{{ __('payment.sentjeUploadImage') }} <small class="text-muted">{{ __('payment.sentjeOptional') }}</small></label>
                    </div>
                    <div class="w-100"></div>
                    <div class="input-group col-lg-4 col-md-5 mt-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">{{ __('payment.sentjeUpload') }}</span>
                        </div>
                        <div class="custom-file">
                            <input name="image" type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" placeholder="{{ __('payment.sentjeChooseImage') }}">
                            <label class="custom-file-label" for="inputGroupFile01">{{ __('payment.sentjeChooseImage') }}</label>
                        </div>
                    </div>
                </div>
                
                <div class="row mb-2">
                    <div class="col-lg-4 col-md-5 mt-2">
                        <img class="img-fluid rounded" id="image" accept=".jpeg, .png, .jpg, .gif, .svg">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-4 col-md-5">
                        <label>{{ __('payment.sentjeActivationDate') }} <small class="text-muted">{{ __('payment.sentjeOptional') }}</small></label>
                        <input name="activation_date" placeholder="{{ __('payment.sentjeActiveAfter') }}" type="text" class="form-control" id="datepicker" autocomplete="off">

                        <input type="hidden" id="localization_info" value="<?= htmlspecialchars(json_encode( __('payment.datePicker') )) ?>">
                    </div>
                </div>
                
                <button type="submit" class="btn btn-success">{{ __('payment.requestSentje') }}</button>
                
            </form>
        </div>
    </div>
</div>
@endsection