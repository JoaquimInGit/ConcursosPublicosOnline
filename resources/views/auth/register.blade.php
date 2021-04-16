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
                <h3>{{ __('Register') }}</h3>
                <div class="text-muted font-weight-bold">{{ __('Enter your details to create your account:') }}</div>
            </div>
            <form  method="POST" action="{{ route('register') }}" class="form">
                @csrf
                <div class="form-group mb-5">
                    <div>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror h-auto form-control-solid py-4 px-8" placeholder="{{ __('Name') }}" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                        <div class="fv-plugins-message-container">
                            <div class="fv-help-block">{{ $message }}</div>
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group mb-5">
                    <div>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror h-auto form-control-solid py-4 px-8" placeholder="{{ __('Email') }}"  name="email" value="{{ old('email') }}" required autocomplete="email">
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

                <!--<div class="form-group mb-5 text-left">
                    <label class="checkbox m-0">
                        <input type="checkbox" name="agree" />I Agree the
                        <a href="#" class="font-weight-bold">terms and conditions</a>.
                        <span></span></label>
                    <div class="form-text text-muted text-center"></div>
                </div>-->
                <div class="form-group d-flex flex-wrap flex-center mt-10">
                    <button type="submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-2">{{ __('Register') }}</button>
                    <a href="{{ route('login') }}" class="btn btn-light-primary font-weight-bold px-9 py-4 my-3 mx-2">{{ __('Login') }}</a>
                </div>
            </form>
        </div>
    </div>
@endsection
