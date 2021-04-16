@extends('layout.default')
<?php
view()->share('pageTitle', __('Settings'));
view()->share('hideSubHeader', true);
?>
@section('breadcrumbs')
    {{ Breadcrumbs::render('settings.index') }}
@endsection
@push('styles')
    <!--<link href="{{ asset('css/datatables.css') }}" rel="stylesheet" type="text/css" >-->
    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <!--begin::Card-->
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <span class="card-icon">
                    <i class="flaticon2-settings text-primary"></i>
                </span>
                <h3 class="card-label">
                    {{ __('Settings') }}
                </h3>
            </div>
            <div class="card-toolbar">
                <div class="dropdown dropdown-inline" id="datatable-buttons">
                </div>
                <a href="{{ route('settings.create') }}" class="btn btn-sm btn-light-primary font-weight-bold">
                    <i class="la la-plus"></i>
                    {{ __('New setting') }}
                </a>
            </div>
        </div>
        <div class="card-body">
            <!--begin: Datatable classes table dataTable no-footer -->
            {{$dataTable->table(['class' => 'table table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline'], true)}}
            <!--end: Datatable -->
        </div>
    </div>
    <!--end::Card-->

@endsection

@push('scripts')
    <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    <!---->
    {{$dataTable->scripts()}}
    <script>
        /*(function(window,$){
            window.LaravelDataTables=window.LaravelDataTables||{};
            window.LaravelDataTables["settings-table"]=$("#settings-table").DataTable({
                "serverSide":true,
                "processing":true,
                "ajax":{"url":"http:\/\/crm-atehp.test\/settings","type":"GET","data":function(data) {
                    for (var i = 0, len = data.columns.length; i < len; i++) {
                        if (!data.columns[i].search.value) delete data.columns[i].search;
                        if (data.columns[i].searchable === true) delete data.columns[i].searchable;
                        if (data.columns[i].orderable === true) delete data.columns[i].orderable;
                        if (data.columns[i].data === data.columns[i].name) delete data.columns[i].name;
                    }
                    delete data.search.regex;
                }},
                "columns":[
                    {"data":"type","name":"type","title":"Type","orderable":true,"searchable":true},
                    {"data":"group","name":"group","title":"Group","orderable":true,"searchable":true},
                    {"data":"name","name":"name","title":"Name","orderable":true,"searchable":true},
                    {"data":"value","name":"value","title":"Value","orderable":true,"searchable":true},
                    {"data":"action","name":"action","title":"Action","orderable":false,"searchable":false,"width":120,"className":"text-center"}
                ],
                "dom":"<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>rtip",
                "order":[[1,"desc"]],
                "buttons":[]});
        })(window,jQuery);*/




        (function(window,$){
            $.fn.dataTable.Buttons.defaults.dom.container.className = '';
            $.fn.dataTable.Buttons.defaults.dom.button.className = 'btn btn-sm btn-default font-weight-bold mr-2';
            var buttons = new $.fn.dataTable.Buttons(window.LaravelDataTables["settings-table"], {
                buttons: [
                    'export',
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
                        jQuery('#settings-table').DataTable().draw(false);
                    });
                }
            });
        }

    </script>
@endpush

