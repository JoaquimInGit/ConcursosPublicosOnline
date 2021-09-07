<?php
/**
 *
 * @var $order \App\Models\Order
 */
view()->share('pageTitle', $order->id);
view()->share('hideSubHeader', true);
?>
@extends('layout.default')
@section('breadcrumbs')
    {{ Breadcrumbs::render('orders.show', $order) }}
@endsection
@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <a href="{{ route('orders.index') }}" class="btn btn-bg-secondary btn-sm mr-3">
                    <i class="fas fa-undo-alt"></i>{{__('Back')}}</a>
                {{--<a href="{{ route('orders.index') }}">
                    <button class="btn btn-sm btn-light-info font-weight-bold">
                        <img alt="Voltar" src="{{ asset('media/logos/voltar.png') }}" width="25px" class="mr-2 pb-2"/>
                        Voltar &nbsp;&nbsp;
                    </button>
                </a>--}}
                &nbsp;&nbsp;
                <h3 class="card-label">
                    {{ $order->name }}
                </h3>
            </div>
            <div class="card-toolbar">
                @if(auth()->user()->can('manageApp'))
                    <a href="{{ route('orders.edit', $order) }}" class="btn btn-sm btn-light-primary font-weight-bold mr-2">
                        <i class="la la-edit"></i>
                        {{ __('Update') }}
                    </a>
                @endif
                <button class="btn btn-sm btn-light-danger font-weight-bold" onclick="destroyConfirmation(this)">
                    <i class="la la-trash"></i>
                    {{ __('Delete') }}
                </button>
                {!! Form::open(['route' => ['orders.destroy', $order], 'method' => 'delete', 'class'=>"d-none", 'id' => 'delete-form']) !!}

                {!! Form::close() !!}
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <tbody>
                    @include('orders.show_fields')
                </tbody>
            </table>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        function destroyConfirmation(e){
            swal.fire({
                title: '{{ __('Are you sure you want to delete this?') }}',
                text: "{!! __("You won't be able to revert this!") !!}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: "{{ __('Yes, delete it!') }}"
            }).then(function(result) {
                if (result.value) {
                    document.getElementById('delete-form').submit();
                }
            });
        }
    </script>
@endpush
