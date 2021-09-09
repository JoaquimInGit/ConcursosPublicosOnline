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
    @if(auth()->user()->can('accessAsUser') && !empty($user->entity))
        <div class="d-flex flex-row">

            <!--begin::Aside-->
            <div class="flex-row-auto offcanvas-mobile w-250px w-xxl-350px" id="kt_profile_aside">
                <!--begin::Profile Card-->
                <div class="card card-custom card-stretch">
                    <!--begin::Body-->
                    <div class="card-body pt-4">
                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end">

                        </div>
                        <!--end::Toolbar-->
                        <!--begin::User-->
                        <div class="d-flex align-items-center">
                            <div class="symbol symbol-60 symbol-xxl-100 mr-5 align-self-start align-self-xxl-center">
                                @if(!empty($entity->user) && $entity->user->hasMedia('avatar'))
                                    <div class="symbol-label" style="background-image:url('{{$entity->user->getFirstMediaUrl('avatar')}}')"></div>
                                @else
                                    <div class="symbol-label"></div>
                                @endif
                                    <i class="symbol-badge bg-success"></i>
                            </div>
                            <div>
                                <a href="#" class="font-weight-bolder font-size-h5 text-dark-75 text-hover-primary">{{$user->entity->name}}</a>
                                {{--<div class="text-muted">{{$entity->getEntityTypeLabelAttribute()}}</div>--}}
                                {{--<div class="mt-2">
                                    <a href="#" class="btn btn-sm btn-primary font-weight-bold mr-2 py-2 px-3 px-xxl-5 my-1">Chat</a>
                                    <a href="#" class="btn btn-sm btn-success font-weight-bold py-2 px-3 px-xxl-5 my-1">Follow</a>
                                </div>--}}
                            </div>
                        </div>
                        <!--end::User-->
                        <!--begin::Contact-->
                        <div class="py-9">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="font-weight-bold mr-2">{{__('Email')}}:</span>
                                <a href="#" class="text-muted text-hover-primary">{{$user->email}}</a>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="font-weight-bold mr-2">{{__('Phone')}}:</span>
                                <span class="text-muted">{{$user->entity->mobile_phone}}</span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <span class="font-weight-bold mr-2">{{__('Location')}}:</span>
                                <span class="text-muted">{{$user->entity->address}}</span>
                            </div>
                        </div>
                        <!--end::Contact-->
                        <!--begin::Nav-->
                        <div class="navi navi-bold navi-hover navi-active navi-link-rounded">

                            <div class="navi-item mb-2">
                                <a href="{{route('users.edit',$user)}}" class="navi-link py-4 {{\Request::route()->getName() === "users.edit" ? 'active' : ''}}" >
                                <span class="navi-icon mr-2">
                                    <span class="svg-icon">
                                        <!--begin::Svg Icon | path:/metronic/theme/html/demo10/dist/assets/media/svg/icons/General/User.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                                <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                </span>
                                    <span class="navi-text font-size-lg">{{__('User Information')}}</span>
                                </a>
                            </div>
                            <div class="navi-item mb-2">
                                <a href="{{route('entities.edit',$user->entity)}}" class="navi-link py-4 {{\Request::route()->getName() === "entities.edit" ? 'active' : ''}}" >
                                <span class="navi-icon mr-2">
                                    <span class="svg-icon">
                                        <!--begin::Svg Icon | path:/metronic/theme/html/demo10/dist/assets/media/svg/icons/General/User.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                                <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                </span>
                                    <span class="navi-text font-size-lg">{{__('Entity Information')}}</span>
                                </a>
                            </div>
                            <div class="navi-item mb-2">
                                <a href="{{route('orders.index')}}" class="navi-link py-4 {{\Request::route()->getName() === "orders.index" ? 'active' : ''}}" >
                                <span class="navi-icon mr-2">
                                    <span class="svg-icon">
                                        <!--begin::Svg Icon | path:/metronic/theme/html/demo10/dist/assets/media/svg/icons/General/User.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                                <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                </span>
                                    <span class="navi-text font-size-lg">{{__('Subscriptions')}}</span>
                                </a>
                            </div>

                        </div>
                        <!--end::Nav-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Profile Card-->
            </div>
            <!--end::Aside-->
            <!--begin::Content-->
            <div class="flex-row-fluid ml-lg-8">
                <!--begin::Card-->
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
                                <input type="text" name="name" class="form-control  form-control-solid @error('name') is-invalid @enderror" placeholder="{{ __('Name') }}" value="{{old('name', $user->name )}}" required>
                                <!--<span class="form-text text-muted">We'll never share your email with anyone else.</span>-->
                                @error('name')
                                    <div class="error invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>{{ __('E-Mail Address') }}</label>
                                <input type="email" name="email" class="form-control  form-control-solid @error('email') is-invalid @enderror"  placeholder="{{ __('E-Mail Address') }}" value="{{old('email', $user->email )}}" required>
                                @error('email')
                                    <div class="error invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>{{ __('Password') }}</label>
                                <input type="password" name="password" class="form-control  form-control-solid @error('password') is-invalid @enderror" placeholder="{{ __('Password') }}">
                                @error('password')
                                    <div class="error invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>{{ __('Confirm Password') }}</label>
                                <input type="password" placeholder="{{ __('Confirm Password') }}" class="form-control form-control-solid" name="password_confirmation" >
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary mr-2">{{ __('Save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
            <!--end::Content-->
        </div>

    @else
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
    @endif

@endsection
@push('scripts')
    <script src="{{ asset('js/pages/image-inputs.js') }}"></script>
@endpush
