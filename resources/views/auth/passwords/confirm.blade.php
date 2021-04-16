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
                <h3>{{ __('Confirm Password') }}</h3>
                <div class="text-muted font-weight-bold">{{ __('Please confirm your password before continuing.') }}</div>
            </div>
            <form  method="POST" action="{{ route('password.confirm') }}" class="form">
                @csrf
                <div class="form-group mb-5">
                    <div>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror h-auto form-control-solid py-4 px-8" placeholder="{{ __('Password') }}" name="password" required autocomplete="current-password">

                        @error('password')
                        <div class="fv-plugins-message-container">
                            <div class="fv-help-block">{{ $message }}</div>
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group d-flex flex-wrap flex-center mt-10">
                    <button type="submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-2">{{ __('Confirm Password') }}</button>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="btn btn-light-primary font-weight-bold px-9 py-4 my-3 mx-2">{{ __('Forgot Your Password?') }}</a>
                    @endif
                </div>
            </form>
        </div>
    </div>
@endsection
