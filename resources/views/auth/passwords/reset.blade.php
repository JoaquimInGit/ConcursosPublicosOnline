@extends('layout.login')

@section('content')
    <div class="login-form text-center p-7 position-relative overflow-hidden">
        <!--begin::Login Header-->
        <div class="d-flex flex-center mb-15">
            <a href="#">
                <img src="media/logos/logo-dark.png" class="max-h-75px" alt="" />
            </a>
        </div>
        <div class="">
            <div class="mb-20">
                <h3>{{ __('Reset Password') }}</h3>
                <div class="text-muted font-weight-bold">{{ __('Enter your email to reset your password:') }}</div>
            </div>
            <form  method="POST" action="{{ route('password.update') }}" class="form">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="form-group mb-5">
                    <div>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror h-auto form-control-solid py-4 px-8" placeholder="{{ __('Email') }}"  name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                        <div class="fv-plugins-message-container">
                            <div class="fv-help-block">{{ $message }}</div>
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group mb-5">
                    <div>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror h-auto form-control-solid py-4 px-8" placeholder="{{ __('Password') }}" name="password" required autocomplete="new-password">

                        @error('password')
                        <div class="fv-plugins-message-container">
                            <div class="fv-help-block">{{ $message }}</div>
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group mb-5">
                    <div>
                        <input id="password-confirm" type="password" class="form-control @error('password-confirm') is-invalid @enderror h-auto form-control-solid py-4 px-8" placeholder="{{ __('Confirm Password') }}" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4">{{ __('Reset Password') }}</button>
            </form>
        </div>
    </div>
@endsection
