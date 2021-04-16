<?php
/**
 *
 * @var $setting \App\Models\Setting
 */
view()->share('pageTitle', $setting->name);
view()->share('hideSubHeader', true);
?>
@extends('layout.default')
@section('breadcrumbs')
    {{ Breadcrumbs::render('settings.edit', $setting) }}
@endsection
@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">
                    {{ $setting->name }}
                </h3>
            </div>
        </div>
        @include('settings._form')
    </div>
@endsection
