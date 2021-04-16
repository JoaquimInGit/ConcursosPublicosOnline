@extends('layout.default')
<?php
view()->share('pageTitle', __('Users'));
view()->share('hideSubHeader', true);
?>
@section('breadcrumbs')
    {{ Breadcrumbs::render('users.index') }}
@endsection
@push('styles')
    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endpush


@section('content')

    <!--begin::Card-->
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <span class="card-icon">
                    <i class="flaticon2-user text-primary"></i>
                </span>
                <h3 class="card-label">
                    {{ __('Users') }}
                </h3>
            </div>
            <div class="card-toolbar">
                <div class="dropdown dropdown-inline" id="datatable-buttons">
                </div>
                @can('manageUsers')
                    <a href="{{ route('users.create') }}" class="btn btn-sm btn-light-primary font-weight-bold">
                        <i class="la la-plus"></i>
                        {{ __('New user') }}
                    </a>
                @endcan
            </div>
        </div>
        <div class="card-body">
            <!--begin: Datatable classes table dataTable no-footer -->
            {{$dataTable->table(['class' => 'table table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline'])}}
            <!--end: Datatable -->
        </div>
    </div>
    <!--end::Card-->
@endsection

@push('scripts')
    <!--<script src="{{ asset('js/datatables.js') }}"></script>-->
    <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    {{$dataTable->scripts()}}
    <script>
        (function(window,$){
            $.fn.dataTable.Buttons.defaults.dom.container.className = '';
            $.fn.dataTable.Buttons.defaults.dom.button.className = 'btn btn-sm btn-default font-weight-bold mr-2';
            var buttons = new $.fn.dataTable.Buttons(window.LaravelDataTables["users-table"], {
                buttons: [
                    'export',
                    //'print',
                    /*{
                        text: 'Orange',
                        className: 'orange'
                    }*/
                ]
            }).container().appendTo($('#datatable-buttons'));
        })(window,jQuery);
        function destroyConfirmation(e){
            var _this =  jQuery(e);
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
                        jQuery('#users-table').DataTable().draw(false);
                    });
                    /*swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )*/
                }
            });
        }


    </script>
@endpush

