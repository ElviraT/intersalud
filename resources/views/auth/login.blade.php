@extends('layouts.base_login')

@section('content')
    <form method="POST" action="{{ route('login') }}" class="md-float-material form-material" autocomplete="off">
        @csrf
        <div class="text-center">
            <img src="{{ asset('img/Logo.png')}}" alt="logo.png" width="25%">
        </div>
        <div class="auth-box card" style="margin-top: -30px">
            <div class="card-block">
                <div class="row m-b-20">
                    <div class="col-md-12">
                        <h3 class="text-center">{{ __('Login') }}</h3>
                    </div>
                </div>

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
                <div class="input-group form-primary">
                    <div class="col-md-11">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">           
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <span class="form-bar"></span>
                        <label class="float-label">{{ __('Password') }}</label>                    
                    </div>
                    <div class="input-group-append">
                        <button id="show_password" class="btn btn-primary btn-sm" type="button" onclick="mostrarPassword()"> <span class="fa fa-eye-slash icon"></span> </button>
                    </div>
                </div>
                <div class="row m-t-25 text-left">
                    <div class="col-12">
                        <div class="checkbox-fade fade-in-primary d-">
                            <label class="form-check-label" for="remember">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                <span class="text-inverse">{{ __('Remember Me') }}</span>
                            </label>
                        </div>
                        <div class="forgot-phone text-right f-right">
                            @if (Route::has('password.request'))
                                    <a class="text-right f-w-600" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                        </div>
                        <div class="row m-t-30">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20">{{ __('Login') }}</button>
                            </div>
                        </div>
                    </div>
                </div>        
            </div>
        </div>
    </form>
    <!-- end of form -->
@endsection
