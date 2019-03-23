@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col pt-5">

            <h1 class="display-4 mb-5">Bank rekening aanpassen</h1>

            <form method="POST" action="<?= URL::to('/accounts/edit/'.$account['id']); ?>">
                @csrf

                <div class="form-group row">
                    <div class="col-lg-4 col-md-5">
                        <label>Naam</label>
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
                            <input placeholder="NL 01 BANK 0123 4567 89" id="IBAN" type="text" class="form-control" name="IBAN" value="{{ $account['IBAN'] }}" required>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-success">Aanpassen</button>
            </form>

        </div>
    </div>
</div>
@endsection