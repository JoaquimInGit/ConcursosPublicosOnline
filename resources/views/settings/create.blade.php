<?php
/**
 *
 * @var $setting \App\Models\Setting
 * @var $errors Illuminate\View\Middleware\ShareErrorsFromSession
 */
view()->share('pageTitle', __('Create setting'));
view()->share('hideSubHeader', true);
?>
@extends('layout.default')
@section('breadcrumbs')
    {{ Breadcrumbs::render('settings.create') }}
@endsection
@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">
                    {{ __('Create setting') }}
                </h3>
            </div>
        </div>
        @include('settings._form')
    </div>
@endsection
