@extends('layouts.base_login')

@section('content')
<div class="container">
    <div class="text-center">
        <img src="{{ asset('img/intersalud.png')}}" alt="logo.png" width="15%">
    </div>
    <div class="row justify-content-center" style="margin-top: -30px">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header" align="center">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}" class="md-float-material form-material">
                        @csrf

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

                         <div class="row m-t-30">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
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
