<?php
/**
 *
 * @var $product \App\Models\Product
 * @var $errors Illuminate\View\Middleware\ShareErrorsFromSession
 */
view()->share('pageTitle', $product->id);
view()->share('hideSubHeader', true);
?>
@extends('layout.default')

@section('breadcrumbs')
    {{ Breadcrumbs::render('products.edit', $product) }}
@endsection
@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">
                    {{ $product->id }}
                </h3>
            </div>
        </div>
        {!! Form::model($product, ['route' => ['products.update', $product], 'method' => 'patch', 'enctype'=>"multipart/form-data", 'class' => "form"]) !!}

            <div class="card-body">
                @include('products.fields')
             </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary mr-2">{{ __('Save') }}</button>
                <!--<button type="reset" class="btn btn-secondary">Cancel</button>-->
            </div>
        {!! Form::close() !!}
    </div>
@endsection