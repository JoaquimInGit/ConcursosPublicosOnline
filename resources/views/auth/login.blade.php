@extends('layout.login')

@section('content')
    <div class="login-form text-center p-7 position-relative overflow-hidden">
        <!--begin::Login Header-->
        <div class="d-flex flex-center mb-15">
            <a href="/">
                <img src="/media/logos/logo-dark.png" class="max-h-75px" alt="" />
            </a>
        </div>
        <div class="login-signin">
            <div class="mb-20">
                <h3>{{ __('Sign In') }}</h3>
                <!--<div class="text-muted font-weight-bold">Enter your details to login to your account:</div>-->
            </div>
            <form  method="POST" action="{{ route('login') }}" class="form">
                @csrf
                <div class="form-group mb-5">
                    <input type="email" class="form-control @error('email') is-invalid @enderror h-auto form-control-solid py-4 px-8" placeholder="{{ __('E-Mail Address') }}" name="email" id="email" autocomplete="email" value="{{old('email')}}" required>
                    @error('email')
                    <div class="fv-plugins-message-container">
                        <div class="fv-help-block">{{ $message }}</div>
                    </div>
                    @enderror
                </div>
                <div class="form-group mb-5">
                    <input type="password" class="form-control @error('password') is-invalid @enderror h-auto form-control-solid py-4 px-8" placeholder="{{ __('Password') }}" name="password" id="password" autocomplete="current-password" required>
                    @error('password')
                    <div class="fv-plugins-message-container">
                        <div class="fv-help-block">{{ $message }}</div>
                    </div>
                    @enderror
                </div>
                <div class="form-group d-flex flex-wrap justify-content-between align-items-center">
                    <div class="checkbox-inline">
                        <label class="checkbox m-0 text-muted">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} >
                        <span></span>{{ __('Remember Me') }}</label>
                    </div>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" id="kt_login_forgot" class="text-muted text-hover-primary">{{ __('Forgot Your Password?') }}</a>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4">{{ __('Login') }}</button>
            </form>
            <div class="mt-10">
                <span class="opacity-70 mr-4">{{ __("Don't have an account yet?") }}</span>
                <a href="{{ route('register') }}" id="kt_login_signup" class="text-muted text-hover-primary font-weight-bold">{{ __('Register') }}</a>
            </div>
        </div>
    </div>

@endsection
