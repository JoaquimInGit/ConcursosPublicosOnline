@extends('layout.login')

@section('content')
    <div class="login-form text-center p-7 position-relative overflow-hidden">
        <!--begin::Login Header-->
        <div class="dflex-center-flex mb-5 ">
            <h1>Concursos Públicos Online</h1>
        </div>
        <div class="">
            <div class="mb-7">
                <h3>{{ __('Register') }}</h3>
                <div class="font-weight-bold">{{ __('Enter your details to create your account:') }}</div>
            </div>
            <form  method="POST" action="{{ route('register') }}" class="form">
                @csrf
                <div class="row">
                <div class="col-md-6">
                <h3>{{ __('Entity') }}</h3>

                <div class="form-group">
                    <div>
                        <input id="entity_name" type="text" class="form-control @error('entity_name') is-invalid @enderror h-auto form-control-solid py-4 px-8" placeholder="{{ __('Name Entity') }}" name="entity_name" value="{{ old('entity_name') }}" required autocomplete="entity_name" autofocus>
                        @error('entity_name')
                        <div class="fv-plugins-message-container">
                            <div class="fv-help-block">{{ $message }}</div>
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group mb-5">
                    <div>
                        <input id="country" type="text" class="form-control @error('country') is-invalid @enderror h-auto form-control-solid py-4 px-8" placeholder="{{ __('Country') }}" name="country" value="{{ old('country') }}" required autocomplete="country">
                        @error('country')
                        <div class="fv-plugins-message-container">
                            <div class="fv-help-block">{{ $message }}</div>
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group mb-5">
                    <div>
                        <input id="district" type="text" class="form-control @error('district') is-invalid @enderror h-auto form-control-solid py-4 px-8" placeholder="{{ __('District') }}" name="district" value="{{ old('entity_name') }}" required autocomplete="district">
                        @error('district')
                        <div class="fv-plugins-message-container">
                            <div class="fv-help-block">{{ $message }}</div>
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group mb-5">
                    <div>
                        <input id="address" type="text" class="form-control @error('address') is-invalid @enderror h-auto form-control-solid py-4 px-8" placeholder="{{ __('Address') }}" name="address" value="{{ old('address') }}" required autocomplete="address">
                        @error('address')
                        <div class="fv-plugins-message-container">
                            <div class="fv-help-block">{{ $message }}</div>
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group mb-5">
                    <div>
                        <input id="postal_code" type="text" class="form-control @error('postal_code') is-invalid @enderror h-auto form-control-solid py-4 px-8" placeholder="{{ __('Postal Code') }}" name="postal_code" value="{{ old('postal_code') }}" required autocomplete="postal_code">
                        @error('postal_code')
                        <div class="fv-plugins-message-container">
                            <div class="fv-help-block">{{ $message }}</div>
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group mb-5">
                    <div>
                        <input id="mobile_phone" type="text" class="form-control @error('mobile_phone') is-invalid @enderror h-auto form-control-solid py-4 px-8" placeholder="{{ __('Mobile Phone') }}" name="mobile_phone" value="{{ old('mobile_phone') }}" required autocomplete="mobile_phone">
                        @error('mobile_phone')
                        <div class="fv-plugins-message-container">
                            <div class="fv-help-block">{{ $message }}</div>
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group mb-5">
                    <div>
                        <input id="nif" type="text" class="form-control @error('nif') is-invalid @enderror h-auto form-control-solid py-4 px-8" placeholder="{{ __('NIF') }}" name="nif" value="{{ old('nif') }}" required autocomplete="nif">
                        @error('nif')
                        <div class="fv-plugins-message-container">
                            <div class="fv-help-block">{{ $message }}</div>
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group mb-15">
                    <div>
                        <input id="cae" type="text" class="form-control @error('cae') is-invalid @enderror h-auto form-control-solid py-4 px-8" placeholder="{{ __('CAE') }}" name="cae" value="{{ old('cae') }}" required autocomplete="cae">
                        @error('cae')
                        <div class="fv-plugins-message-container">
                            <div class="fv-help-block">{{ $message }}</div>
                        </div>
                        @enderror
                    </div>
                </div>
                </div>
                <div class="col-md-6">
                <div class="mt-20">
                    <h3>{{ __('User') }}</h3>
                </div>
                <div class="form-group mb-5">
                    <div>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror h-auto form-control-solid py-4 px-8" placeholder="{{ __('Name') }}" name="name" value="{{ old('name') }}" required autocomplete="name">
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
                    <button type="submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-2">{{ __('Register') }}</button>
                    <a href="{{ route('login') }}" class="btn btn-light-primary font-weight-bold px-9 py-4 my-3 mx-2 ">{{ __('Login') }}</a>
                </div>
                </div>
                <!--<div class="form-group mb-5 text-left">
                    <label class="checkbox m-0">
                        <input type="checkbox" name="agree" />I Agree the
                        <a href="#" class="font-weight-bold">terms and conditions</a>.
                        <span></span></label>
                    <div class="form-text text-muted text-center"></div>
                </div>-->



            </form>
        </div>
    </div>
@endsection
