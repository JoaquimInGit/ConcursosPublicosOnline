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
                <div class="text-muted font-weight-bold">
                    @if (session('status'))
                        <div class="alert alert-success mb-3" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ __('Enter your email to reset your password:') }}
                </div>
            </div>
            <form  method="POST" action="{{ route('password.email') }}" class="form">
                @csrf
                <div class="form-group mb-5">
                    <div>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror h-auto form-control-solid py-4 px-8" placeholder="{{ __('Email') }}"  name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                        <div class="fv-plugins-message-container">
                            <div class="fv-help-block">{{ $message }}</div>
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group d-flex flex-wrap flex-center mt-10">
                    <button type="submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-2">{{ __('Request') }}</button>
                    <a href="{{ route('login') }}" class="btn btn-light-primary font-weight-bold px-9 py-4 my-3 mx-2">{{ __('Cancel') }}</a>
                </div>
            </form>
        </div>
    </div>

@endsection
