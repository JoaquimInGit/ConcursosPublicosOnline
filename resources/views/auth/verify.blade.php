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
                <h3>{{ __('Verify Your Email Address') }}</h3>
                <div class="text-muted font-weight-bold">
                    @if (session('resent'))
                        <div class="alert alert-success mb-3" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif
                    {{ __('Before proceeding, please check your email for a verification link.') }}<br>
                    {{ __('If you did not receive the email please request another') }}
                </div>
            </div>
            <form  method="POST" action="{{ route('verification.resend') }}" class="form">
                @csrf
                <div class="form-group d-flex flex-wrap flex-center mt-0">
                    <button type="submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-2">{{ __('Request another') }}</button>
                    <a href="{{ route('login') }}" class="btn btn-light-primary font-weight-bold px-9 py-4 my-3 mx-2">{{ __('Cancel') }}</a>
                </div>
            </form>
        </div>
    </div>
@endsection
