@extends('layout.default')
<?php
view()->share('pageTitle', __('Orders'));
view()->share('hideSubHeader', true);
?>
@section('breadcrumbs')
    {{ Breadcrumbs::render('orders.index') }}
@endsection
@push('styles')
    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')

    @if(auth()->user()->can('accessAsUser') && !empty($entity))
    <div class="d-flex flex-row">

        <!--begin::Aside-->
        <div class="flex-row-auto offcanvas-mobile w-250px w-xxl-350px" id="kt_profile_aside">
            <!--begin::Profile Card-->
            <div class="card card-custom card-stretch">
                <!--begin::Body-->
                <div class="card-body pt-4">
                    <!--begin::Toolbar-->
                    <div class="d-flex justify-content-end">

                    </div>
                    <!--end::Toolbar-->
                    <!--begin::User-->
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-60 symbol-xxl-100 mr-5 align-self-start align-self-xxl-center">
                            {{--<div class="symbol-label" style="background-image:url('{{$entity->user->getFirstMediaUrl('avatar')}}')"></div>--}}
                            <i class="symbol-badge bg-success"></i>
                        </div>
                        <div>
                            <a href="#" class="font-weight-bolder font-size-h5 text-dark-75 text-hover-primary">{{$entity->name}}</a>
                            {{--<div class="text-muted">{{$entity->getEntityTypeLabelAttribute()}}</div>--}}
                            {{--<div class="mt-2">
                                <a href="#" class="btn btn-sm btn-primary font-weight-bold mr-2 py-2 px-3 px-xxl-5 my-1">Chat</a>
                                <a href="#" class="btn btn-sm btn-success font-weight-bold py-2 px-3 px-xxl-5 my-1">Follow</a>
                            </div>--}}
                        </div>
                    </div>
                    <!--end::User-->
                    <!--begin::Contact-->
                    <div class="py-9">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="font-weight-bold mr-2">{{__('Email')}}:</span>
                            <a href="#" class="text-muted text-hover-primary">{{$entity->user->email}}</a>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="font-weight-bold mr-2">{{__('Phone')}}:</span>
                            <span class="text-muted">{{$entity->mobile_phone}}</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="font-weight-bold mr-2">{{__('Location')}}:</span>
                            <span class="text-muted">{{$entity->address}}</span>
                        </div>
                    </div>
                    <!--end::Contact-->
                    <!--begin::Nav-->
                    <div class="navi navi-bold navi-hover navi-active navi-link-rounded">

                        <div class="navi-item mb-2">
                            <a href="{{route('users.edit',$entity->user)}}" class="navi-link py-4 {{\Request::route()->getName() === "users.edit" ? 'active' : ''}}" >
                                <span class="navi-icon mr-2">
                                    <span class="svg-icon">
                                        <!--begin::Svg Icon | path:/metronic/theme/html/demo10/dist/assets/media/svg/icons/General/User.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                                <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                </span>
                                <span class="navi-text font-size-lg">{{__('User Information')}}</span>
                            </a>
                        </div>
                        <div class="navi-item mb-2">
                            <a href="{{route('entities.edit',$entity)}}" class="navi-link py-4 {{\Request::route()->getName() === "entities.edit" ? 'active' : ''}}" >
                                <span class="navi-icon mr-2">
                                    <span class="svg-icon">
                                        <!--begin::Svg Icon | path:/metronic/theme/html/demo10/dist/assets/media/svg/icons/General/User.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                                <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                </span>
                                <span class="navi-text font-size-lg">{{__('Entity Information')}}</span>
                            </a>
                        </div>
                        <div class="navi-item mb-2">
                            <a href="{{route('orders.index')}}" class="navi-link py-4 {{\Request::route()->getName() === "orders.index" ? 'active' : ''}}" >
                                <span class="navi-icon mr-2">
                                    <span class="svg-icon">
                                        <!--begin::Svg Icon | path:/metronic/theme/html/demo10/dist/assets/media/svg/icons/General/User.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                                <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                </span>
                                <span class="navi-text font-size-lg">{{__('Subscriptions')}}</span>
                            </a>
                        </div>

                    </div>
                    <!--end::Nav-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Profile Card-->
        </div>
        <!--end::Aside-->
        <!--begin::Content-->
            <div class="flex-row-fluid ml-lg-8">
                <!--begin::Card-->
                <div class="card card-custom card-stretch">
                    <div class="card-header">
                        <div class="card-title">
                            <span class="card-icon">
                                <i class="flaticon2-settings text-primary"></i>
                            </span>
                            <h3 class="card-label">
                                {{ __('Subscriptions') }}
                            </h3>
                        </div>
                        <div class="card-toolbar">
                            <a href="{{ route('orders.create') }}" class="btn btn-sm btn-light-primary font-weight-bold">
                                <i class="la la-plus"></i>
                                {{ __('New Subscription') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <!--begin: Datatable classes table dataTable no-footer -->
                        {{$dataTable->table(['class' => 'table table-bordered table-hover table-checkable dataTable no-footer dtr-inline'], false)}}
                        <!--end: Datatable -->
                    </div>
                </div>
            </div>
            <!--end::Content-->
        </div>

    @else
        <!--begin::Card-->
        <div class="card card-custom">
            <div class="card-header">
                <div class="card-title">
                    {{--<a href="{{ URL::previous() }}">
                        <button class="btn btn-sm btn-light-info font-weight-bold">
                            <img alt="Voltar" src="{{ asset('media/logos/voltar.png') }}" width="25px" class="mr-2 pb-2"/>
                            Voltar &nbsp;&nbsp;
                        </button>
                    </a>--}}
                    &nbsp;&nbsp;
                    <h3 class="card-label">
                        {{ __('Orders') }}
                    </h3>
                </div>
                @if(auth()->user()->can('accessAsUser'))
                    <div class="card-toolbar">
                        <a href="{{ route('orders.create') }}" class="btn btn-sm btn-light-primary font-weight-bold">
                            <i class="la la-plus"></i>
                            {{ __('New Subscription') }}
                        </a>
                    </div>
                @endif
            </div>
            <div class="card-body">
                <!--begin: Datatable classes table dataTable no-footer -->
                {{$dataTable->table(['class' => 'table table-bordered table-hover table-checkable dataTable no-footer dtr-inline'], false)}}
                <!--end: Datatable -->
            </div>
        </div>
        <!--end::Card-->
    @endif

@endsection

@push('scripts')
    <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    {{$dataTable->scripts()}}
    <script>

        jQuery(document).ready(function() {
            $('#order_items_table_filter').css('display', 'none');
        });
        (function(window,$){
            $.fn.dataTable.Buttons.defaults.dom.container.className = '';
            $.fn.dataTable.Buttons.defaults.dom.button.className = 'btn btn-sm btn-default font-weight-bold mr-2';
            var buttons = new $.fn.dataTable.Buttons(window.LaravelDataTables["order_items-table"], {
                buttons: [
                    'export',
                ]
            }).container().appendTo($('#datatable-buttons'));
        })(window,jQuery);

        function destroyConfirmation(e){
            var _this =  jQuery(e);
            console.log(_this);
            swal.fire({
                title: '{{ __('Are you sure you want to delete this?') }}',
                text: "{!! __("You won't be able to revert this!") !!}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: "{{ __('Yes, delete it!') }}"
            }).then(function(result) {

                if (result.value) {
                    //jQuery("#"+_this.data('destroy-form-id')).submit();
                    jQuery.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    jQuery.ajax({
                        url: _this.data('delete-url'),
                        type: 'POST',
                        dataType: 'json',
                        data: {_method: 'DELETE'}
                    }).always(function (data) {
                        console.log(jQuery('#orders_items-table'));
                        jQuery('#order_items-table').DataTable().draw(false);
                    });
                }
            });
        }

    </script>
@endpush
