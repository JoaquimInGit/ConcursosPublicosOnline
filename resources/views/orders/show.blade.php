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
    @if(auth()->user()->can('manageUsers'))
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
    @else
        <div class="card card-custom">
            <div class="card-body p-0">
                <!--begin::Invoice-->
                <div class="row justify-content-center pt-8 px-8 pt-md-27 px-md-0">
                    <div class="col-md-9">
                        <!-- begin: Invoice header-->
                        <div class="d-flex justify-content-between pb-10 pb-md-20 flex-column flex-md-row">
                            <h1 class="display-4 font-weight-boldest mb-10">{{__('INVOICE')}}</h1>
                            <div class="d-flex flex-column align-items-md-end px-0">
                                <!--begin::Logo-->
                                <!--end::Logo-->
                                <span class="d-flex flex-column align-items-md-end font-size-h5 font-weight-bold text-muted">
                                    <span>{{!empty($order->status) ? strtoupper($order->getStatusLabelAttribute()) : ''}}</span>
                                </span>
                            </div>
                        </div>
                        {{--<div class="rounded-xl overflow-hidden w-100 max-h-md-250px mb-30">
                            <img src="/metronic/theme/html/demo1/dist/assets/media/bg/bg-invoice-5.jpg" class="w-100" alt="">
                        </div>--}}
                        <!--end: Invoice header-->
                        <!--begin: Invoice body-->
                        <div class="row border-bottom pb-10">
                            <div class="col-md-12 py-md-10 pr-md-10">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th class="pt-1 pb-9 pl-0 font-weight-bolder text-muted font-size-lg text-uppercase">{{__('Name')}}</th>
                                            <th class="pt-1 pb-9 text-right pr-0 font-weight-bolder text-muted font-size-lg text-uppercase">{{__('Subtotal')}}</th>
                                            <th class="pt-1 pb-9 text-right pr-0 font-weight-bolder text-muted font-size-lg text-uppercase">{{__('Total')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($order->orderItems as $item)
                                            <tr class="font-weight-bolder font-size-lg">
                                                <td class="border-top-0 pl-0 pt-7 d-flex align-items-center">
                                                    <span class="navi-icon mr-2">
                                                        <i class="fa fa-genderless text-danger font-size-h2"></i>
                                                    </span>{{$item->order->name}}</td>
                                                <td class="text-right pt-7">{{!empty($item->price) ? $item->price . ' €' : '----'}}</td>
                                                <td class="pr-0 pt-7 font-size-h6 font-weight-boldest text-right">{{!empty($item->iva) ? $item->iva . ' €' : '----'}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="border-bottom w-100 mt-7 mb-13"></div>
                                <div class="d-flex flex-column flex-md-row">
                                    <div class="d-flex flex-column mb-10 mb-md-0">
                                        <div class="font-weight-bold font-size-h6 mb-3">{{__('TRANSFERÊNCIA BANCÁRIA')}}</div>
                                        <div class="d-flex justify-content-between font-size-lg mb-3">
                                            <span class="font-weight-bold mr-15">{{__('Account Name:')}}</span>
                                            <span class="text-right">NoOperation</span>
                                        </div>
                                        <div class="d-flex justify-content-between font-size-lg mb-3">
                                            <span class="font-weight-bold mr-15">{{__('Entity:')}}</span>
                                            <span class="text-right">{{$order->mb_entity}}</span>
                                        </div>
                                        <div class="d-flex justify-content-between font-size-lg">
                                            <span class="font-weight-bold mr-15">{{__('Reference:')}}</span>
                                            <span class="text-right">{{$order->mb_ref}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end: Invoice body-->
                    </div>
                </div>
                <!-- begin: Invoice action-->
                <div class="row justify-content-center py-8 px-8 py-md-28 px-md-0">
                    <div class="col-md-9 row">
                        <div class="col-md-3 row mb-5">
                            <label for="phone_number">{{__('MbWay Phone Number')}}</label>
                            <input type="text" id="phone_number" class="form-control" placeholder="{{__('MbWay Phone Number')}}" value="{{!empty($order->entity->mobile_phone) ? $order->entity->mobile_phone : ''}}">
                        </div>
                        {{--<div class="d-flex font-size-sm flex-wrap">

                        </div>--}}
                    </div>
                    <div class="col-md-9">
                        <div class="d-flex font-size-sm flex-wrap">
                            <button type="button" class="btn btn-primary font-weight-bolder py-4 mr-3 mr-sm-14 my-1" onclick="payWithMbway({{$order->id}})">{{__('MbWay Payment')}}</button>
                            {{--<button type="button" class="btn btn-light-primary font-weight-bolder mr-3 my-1">Download</button>--}}
                            <button type="button" class="btn btn-dark font-weight-bolder ml-sm-auto my-1">{{('Invoice')}}</button>
                        </div>
                    </div>
                </div>
                <!-- end: Invoice action-->
                <!--end::Invoice-->
            </div>
        </div>
    @endif
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

        function payWithMbway(order){
            console.log(order);
            if($('#phone_number').val() !== '' && $('#phone_number').val() != null){
                $.ajax({
                    url : '{{route('orders.pay_with_mbway')}}' ,
                    method : "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{order_id: order, phone: $('#phone_number').val()},
                    success: function(response) {
                        if(response.success){
                            toastr.info('Referência gerada com sucesso');
                        }else{
                            toastr.warning('Ocorreu um erro. Tente mais tarde.');
                        }
                        console.log(response);
                    }

                });
            }
        }


    </script>
@endpush
