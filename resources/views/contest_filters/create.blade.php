<?php
/**
 *
 * @var $contestFilter \App\Models\ContestFilter;
 * @var $errors Illuminate\View\Middleware\ShareErrorsFromSession
 */
view()->share('pageTitle', __('Create Contest Filter'));
view()->share('hideSubHeader', true);
?>
@extends('layout.default')

@section('breadcrumbs')
    {{ Breadcrumbs::render('contest-filters.create') }}
@endsection
@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">
                    {{ __('Create Contest Filter') }}
                </h3>
            </div>
        </div>
        {!! Form::model($contestFilter, ['route' => ['contest-filters.store'], 'method' => 'post', 'enctype'=>"multipart/form-data", 'class' => "form"]) !!}
            <div class="card-body">
                @include('contest_filters.fields')
             </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary mr-2">{{ __('Save') }}</button>
                <!--<button type="reset" class="btn btn-secondary">Cancel</button>-->
            </div>
        {!! Form::close() !!}
    </div>
@endsection