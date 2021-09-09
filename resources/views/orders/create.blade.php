<?php
/**
 *
 * @var $order \App\Models\Order;
 * @var $errors Illuminate\View\Middleware\ShareErrorsFromSession
 */
view()->share('pageTitle', __('Create Order'));
view()->share('hideSubHeader', true);
?>
@extends('layout.default')

@section('breadcrumbs')
    {{ Breadcrumbs::render('orders.create') }}
@endsection
@section('content')
    {{--<div class="card card-custom">--}}
    <div>
        {!! Form::model($order, ['route' => ['orders.store'], 'method' => 'post', 'enctype'=>"multipart/form-data", 'class' => "form"]) !!}
        <div class="card-body">
            @include('orders.fields')
        </div>
        {!! Form::close() !!}
    </div>

    {{--</div>--}}
@endsection