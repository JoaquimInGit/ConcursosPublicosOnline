<?php
/**
 *
 * @var $filter \App\Models\Filter;
 * @var $errors Illuminate\View\Middleware\ShareErrorsFromSession
 */

use App\Models\Entity;

view()->share('pageTitle', __('Create Filter'));
view()->share('hideSubHeader', true);

?>
@extends('layout.default')

@section('breadcrumbs')
    {{ Breadcrumbs::render('filters.create') }}
@endsection
@section('content')

    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <a href="{{ URL::previous() }}">
                    <img alt="Voltar" src="{{ asset('media/logos/voltar.png') }}" width="25px" class="mr-2 pb-2"/>
                </a>
                <h3 class="card-label">
                    {{ __('Create Filter') }}
                </h3>
            </div>
        </div>
        {!! Form::model($filter, ['id'=>'form','route' => ['filters.store'], 'method' => 'post', 'enctype'=>"multipart/form-data", 'class' => "form"]) !!}
            <div class="card-body">
                @include('filters.fields')
             </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary mr-2">{{ __('Save') }}</button>
                <!--<button type="reset" class="btn btn-secondary">Cancel</button>-->
            </div>
        {!! Form::close() !!}
    </div>
    <script>
        jQuery(document).keypress(function(e) {

            //Enter key
            if (e.which == 13) {
                return false;
            }
        });
    </script>
@endsection