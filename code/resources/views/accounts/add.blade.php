@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col pt-5">

            <h1 class="display-4 mb-5">{{ __('text.bankAccountAdd') }}</h1>

            @if (\Session::has('info'))
                <div class="alert alert-info mt-3">
                    {!! \Session::get('info') !!}
                </div>
            @endif

            <form method="POST" action="<?= URL::to('/accounts/add'); ?>" class="ibanform" novalidate>
                @csrf

                <div class="form-group row">
                    <div class="col-lg-4 col-md-5">
                        <label>{{ __('text.name') }}</label>
                        <input disabled type="text"class="form-control" placeholder="{{ Auth::user()->name }}">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-4 col-md-5">
                        <label for="IBAN">IBAN</label>
                        
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-university"></i>
                                </span>
                            </div>
                            <input placeholder="NL01 BANK 0123 4567 89" id="IBAN" type="text" class="form-control" name="IBAN" required autofocus>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-success">{{ __('text.bankAccountAdd') }}</button>
            </form>

        </div>
    </div>
</div>
@endsection