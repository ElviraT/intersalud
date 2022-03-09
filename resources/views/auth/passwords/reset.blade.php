@extends('layouts.base_login')

@section('content')
<div class="container">
    <div class="text-center">
            <img src="{{ asset('img/Logo.png')}}" alt="logo.png" width="25%">
        </div>
    <div class="row justify-content-center" style="margin-top: -30px">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}" class="md-float-material form-material">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group form-primary">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            <span class="form-bar"></span>
                            <label class="float-label">{{ __('E-Mail Address') }}</label>
                        </div>

                        <div class="form-group form-primary" style="margin-top: 30px;">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <span class="form-bar"></span>
                            <label class="float-label">{{ __('Password') }}</label>
                        </div>
                        <div class="form-group form-primary" style="margin-top: 30px;">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            <span class="form-bar"></span>
                            <label class="float-label">{{ __('Confirm Password') }}</label>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
