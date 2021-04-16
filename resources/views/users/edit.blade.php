<?php
/**
 *
 * @var $user \App\Models\User
 */

view()->share('pageTitle', $user->name);
view()->share('hideSubHeader', true);

?>
@extends('layout.default')
@section('breadcrumbs')
    @can('manageUsers')
        {{ Breadcrumbs::render('users.edit', $user) }}
    @else
        {{ Breadcrumbs::render('users.own_edit', $user) }}
    @endcan
@endsection
@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">
                    {{ $user->name }}
                </h3>
            </div>
        </div>
        <form class="form" method="POST" action="{{route('users.update', $user)}}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="card-body">

                <div class="form-group row">


                    <!--<div class="col">
                        <div class="image-input image-input-outline {{ $user->hasMedia('avatar') ? 'kt-avatar--changed' : 'image-input-empty'}}" id="kt_avatar_single" style="background-image: url(/images/default_user.jpg)" data-default-image="/images/default_user.jpg" data-delete-input-id="delete-image-input">
                            <div id="avatar-holder" class="image-input-wrapper" style="background-image: url({{ $user->getFirstMediaUrl('avatar') }})"></div>
                            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="{{ __('Change image') }}">
                                <i class="fa fa-pen icon-sm text-muted"></i>
                                <input type="file" name="image" accept=".png, .jpg, .jpeg" />
                                <input type="hidden" id="delete-image-input" name="delete_image" value="{{ old('delete_image') }}" />
                            </label>
                            <span class="kt-avatar__cancel btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="{{ __('Cancel image') }}">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>
                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="{{ __('Remove image') }}">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>
                        </div>
                        <span class="form-text text-muted">{{ __('Allowed file types: png, jpg, jpeg.') }}</span>
                    </div>-->

                    <div class="col">
                        <div class="image-input image-input-outline {{ $user->hasMedia('avatar') ? '' : 'image-input-empty'}}" id="kt_image_4" style="background-image: url(/images/default_user.jpg)">
                            <div class="image-input-wrapper" @if($user->hasMedia('avatar')) style="background-image: url('{{ $user->getFirstMediaUrl('avatar') }}')" @endif></div>
                            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="{{ __('Change image') }}">
                                <i class="fa fa-pen icon-sm text-muted"></i>
                                <input type="file" name="image" accept=".png, .jpg, .jpeg" />
                                <input type="hidden" name="delete_image" value="{{ old('delete_image') }}" />
                            </label>
                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="{{ __('Cancel image') }}">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>
                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="{{ __('Remove image') }}">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>
                        </div>
                        <span class="form-text text-muted">{{ __('Allowed file types: png, jpg, jpeg.') }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label>{{ __('Name') }}</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="{{ __('Name') }}" value="{{old('name', $user->name )}}" required>
                    <!--<span class="form-text text-muted">We'll never share your email with anyone else.</span>-->
                    @error('name')
                    <div class="error invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>{{ __('E-Mail Address') }}</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"  placeholder="{{ __('E-Mail Address') }}" value="{{old('email', $user->email )}}" required>
                    @error('email')
                    <div class="error invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>{{ __('Password') }}</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{ __('Password') }}">
                    @error('password')
                    <div class="error invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>{{ __('Confirm Password') }}</label>
                    <input type="password" placeholder="{{ __('Confirm Password') }}" class="form-control" name="password_confirmation" >
                </div>
                @can('manageUsers')
                    <!-- Roles Form Input -->
                    <div class="form-group">
                        {!! Form::label('roles[]', 'Roles') !!}
                        {!! Form::select('roles[]', $roles, isset($user) ? $user->roles->pluck('id')->toArray() : null,  ['id' => 'select-roles','class' => 'form-control select2 '.($errors->has('roles') ? "is-invalid" : ""), 'multiple']) !!}
                        @error('roles')
                            <div class="error invalid-feedback">{{ $message }}</div>
                        @enderror
                        @push('scripts')
                            <script>
                                jQuery(document).ready(function() {
                                    $("#select-roles").select2({
                                        placeholder: '{{ __('Select a role') }}',
                                        allowClear: true,
                                    });
                                });
                            </script>
                        @endpush
                    </div>
                    <!-- Permissions -->
                    @if(isset($user))
                        @include('users._permissions', ['closed' => 'true', 'model' => $user ])
                    @endif
                @endcan
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
