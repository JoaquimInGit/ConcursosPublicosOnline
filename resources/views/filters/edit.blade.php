<?php
/**
 *
 * @var $filter \App\Models\Filter
 * @var $errors Illuminate\View\Middleware\ShareErrorsFromSession
 */
view()->share('pageTitle', $filter->id);
view()->share('hideSubHeader', true);
?>
@extends('layout.default')

@section('breadcrumbs')
    {{ Breadcrumbs::render('filters.edit', $filter) }}
@endsection
@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <a href="{{ route('filters.index') }}" class="btn btn-bg-secondary btn-sm mr-3">
                    <i class="fas fa-undo-alt"></i>{{__('Back')}}</a>
                {{--<a href="{{ route('filters.index') }}">
                    <button class="btn btn-sm btn-light-info font-weight-bold">
                        <img alt="Voltar" src="{{ asset('media/logos/voltar.png') }}" width="25px" class="mr-2 pb-2"/>
                        Voltar &nbsp;&nbsp;
                    </button>
                </a>--}}
                &nbsp;&nbsp;
                <h3 class="card-label">
                    {{ $filter->filter_name }}
                </h3>
            </div>
        </div>
        {!! Form::model($filter, ['route' => ['filters.update', $filter], 'method' => 'patch', 'enctype'=>"multipart/form-data", 'class' => "form"]) !!}

            <div class="card-body">
                @include('filters.fields')
             </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary mr-2">{{ __('Save') }}</button>
                <!--<button type="reset" class="btn btn-secondary">Cancel</button>-->
            </div>
        {!! Form::close() !!}
    </div>
@endsection