<?php
/**
 *
 * @var $entity \App\Models\Entity
 * @var $errors Illuminate\View\Middleware\ShareErrorsFromSession
 */
view()->share('pageTitle', $entity->id);
view()->share('hideSubHeader', true);
?>
@extends('layout.default')

@section('breadcrumbs')
    {{ Breadcrumbs::render('entities.edit', $entity) }}
@endsection
@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <a href="{{ URL::previous() }}">
                    <img alt="Voltar" src="{{ asset('media/logos/voltar.png') }}" width="25px" class="mr-2 pb-2"/>
                </a>
                <h3 class="card-label">
                    {{ $entity->name }}
                </h3>
            </div>
        </div>
        {!! Form::model($entity, ['route' => ['entities.update', $entity], 'method' => 'patch', 'enctype'=>"multipart/form-data", 'class' => "form"]) !!}

            <div class="card-body">
                @include('entities.fields')
             </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary mr-2">{{ __('Save') }}</button>
                <!--<button type="reset" class="btn btn-secondary">Cancel</button>-->
            </div>
        {!! Form::close() !!}
    </div>
@endsection