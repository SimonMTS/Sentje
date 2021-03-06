@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col pt-5">

            @if( session('successUser') !== null )
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('successUser')[0] }}</strong>{{ session('successUser')[1] }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                    </button>
                </div>
            @endif

            <h1 class="display-4 mb-5">{{ __('text.profile') }}</h1>

            <form method="POST" action="<?= URL::to('/profile/'.$user['id']); ?>">
                @csrf

                <div class="form-group row">
                    <div class="col-lg-4 col-md-5">
                        <label>{{ __('text.name') }}</label>
                        <input type="text" name="name" class="form-control" value="{{ $user['name'] }}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-4 col-md-5">
                        <label>{{ __('text.email') }}</label>
                        <input type="text" name="email" class="form-control" value="{{ $user['email'] }}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-4 col-md-5">
                        <hr class="mt-2">
                        <label>{{ __('text.password') }}</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-4 col-md-5">
                        <label>{{ __('text.passwordRepeat') }}</label>
                        <input type="password" name="password_confirm" class="form-control">
                    </div>
                </div>

                <button type="submit" class="btn btn-success">{{ __('text.bankEdit') }}</button>
            </form>

        </div>
    </div>
</div>
@endsection
