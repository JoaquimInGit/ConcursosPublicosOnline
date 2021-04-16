<?php
/**
 *
 * @var $user \App\Models\User
 */
view()->share('pageTitle', __('Create new user'));
view()->share('hideSubHeader', true);
?>
@extends('layout.default')
@section('breadcrumbs')
    {{ Breadcrumbs::render('users.create') }}
@endsection
@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">
                    {{ __('Create new user') }}
                </h3>
            </div>
        </div>
        <form class="form" method="POST" action="{{route('users.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group row">
                    <div class="col">
                        <div class="image-input image-input-outline" id="kt_image_4" style="background-image: url(/images/default_user.jpg)">
                            <div class="image-input-wrapper"></div>
                            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="{{ __('Change image') }}">
                                <i class="fa fa-pen icon-sm text-muted"></i>
                                <input type="file" name="image" accept=".png, .jpg, .jpeg" />
                                <input type="hidden" name="delete_image" value="{{ old('delete_image') }}" />
                            </label>
                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="{{ __('Cancel image') }}">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>
                        </div>
                        <span class="form-text text-muted">{{ __('Allowed file types: png, jpg, jpeg.') }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label>{{ __('Name') }}</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="{{ __('Name') }}" value="{{old('name', $user->name ?? '' )}}" required>
                    <!--<span class="form-text text-muted">We'll never share your email with anyone else.</span>-->
                    @error('name')
                    <div class="error invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>{{ __('E-Mail Address') }}</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"  placeholder="{{ __('E-Mail Address') }}" value="{{old('email', $user->email ?? '' )}}" required>
                    @error('email')
                    <div class="error invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>{{ __('Password') }}</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{ __('Password') }}" required>
                    @error('password')
                    <div class="error invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>{{ __('Confirm Password') }}</label>
                    <input type="password" placeholder="{{ __('Confirm Password') }}" class="form-control" name="password_confirmation" required>
                </div>
                <!-- Roles Form Input -->
                <div class="form-group">
                    {!! Form::label('roles[]', 'Roles') !!}
                    {!! Form::select('roles[]', $roles, isset($user) ? $user->roles->pluck('id')->toArray() : null,  ['class' => 'form-control '.($errors->has('roles') ? "is-invalid" : ""), 'multiple']) !!}
                    @error('roles')
                        <div class="error invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Permissions -->
                @if(isset($user))
                    @include('_permissions', ['closed' => 'true', 'model' => $user ])
                @endif
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary mr-2">{{ __('Save') }}</button>
                <!--<button type="reset" class="btn btn-secondary">Cancel</button>-->
            </div>
        </form>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('js/pages/image-inputs.js') }}"></script>
@endpush
