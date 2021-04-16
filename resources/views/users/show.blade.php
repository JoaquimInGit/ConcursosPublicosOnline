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
        {{ Breadcrumbs::render('users.show', $user) }}
    @else
        {{ Breadcrumbs::render('users.own_show', $user) }}
    @endcan
@endsection
@section('content')
    <!--begin::Card-->
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">
                    {{ $user->name }}
                </h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-light-primary font-weight-bold mr-2">
                    <i class="la la-edit"></i>
                    {{ __('Update') }}
                </a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <tbody>
                <tr>
                    <th scope="row">{{ __('Image') }}</th>
                    <td><img src="{{ $user->getFirstMediaUrl('avatar') }}" width="120"></td>
                </tr>
                <tr>
                    <th scope="row">{{ __('Name') }}</th>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <th scope="row">{{ __('Email') }}</th>
                    <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                </tr>
                <tr>
                    <th scope="row">{{ __('Roles') }}</th>
                    <td>{{ $user->roles_label }}</td>
                </tr>
                <tr>
                    <th scope="row">{{ __('Override Permissions') }}</th>
                    <td>{{ $user->permissions_label }}</td>
                </tr>
                <tr>
                    <th scope="row">{{ __('Email verified at') }}</th>
                    <td>{{$user->email_verified_at }}</td>
                </tr>
                <tr>
                    <th scope="row">{{ __('Created at') }}</th>
                    <td>{{$user->created_at}}</td>
                </tr>
                <tr>
                    <th scope="row">{{ __('Updated at') }}</th>
                    <td>{{$user->updated_at}}</td>
                </tr>

                </tbody>
            </table>
        </div>
    </div>
    <!--end::Card-->
@endsection
