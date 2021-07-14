<?php
/**
 *
 * @var $contest \App\Models\Contest
 * @var $errors Illuminate\View\Middleware\ShareErrorsFromSession
 */
view()->share('pageTitle', $contest->id);
view()->share('hideSubHeader', true);
?>
@extends('layout.default')

@section('breadcrumbs')
    {{ Breadcrumbs::render('contests.edit', $contest) }}
@endsection
@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <a href="{{ URL::previous() }}">
                    <button class="btn btn-sm btn-light-info font-weight-bold">
                        <img alt="Voltar" src="{{ asset('media/logos/voltar.png') }}" width="25px" class="mr-2 pb-2"/>
                        Voltar &nbsp;&nbsp;
                    </button>
                </a>
                &nbsp;&nbsp;
                <h3 class="card-label">
                    {{ $contest->description }}
                </h3>
            </div>
        </div>
        {!! Form::model($contest, ['route' => ['contests.update', $contest], 'method' => 'patch', 'enctype'=>"multipart/form-data", 'class' => "form"]) !!}

            <div class="card-body">
                @include('contests.fields')
             </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary mr-2">{{ __('Save') }}</button>
                <!--<button type="reset" class="btn btn-secondary">Cancel</button>-->
            </div>
        {!! Form::close() !!}
    </div>
@endsection