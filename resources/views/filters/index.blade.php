@extends('layout.default')
<?php
view()->share('pageTitle', __('Filters'));
view()->share('hideSubHeader', true);
?>
@section('breadcrumbs')
    {{ Breadcrumbs::render('filters.index') }}
@endsection
@push('styles')
    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <!--begin::Card-->
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">
                    {{ __('Filters') }}
                </h3>
            </div>
            @if(\App\Models\Entity::getCurrentEntity() == null)
                <div class="card-toolbar">
                    <a onclick="alert('O utilizador tem de ter uma entidade associada.')" class="btn btn-sm btn-light-primary font-weight-bold">
                        <i class="la la-plus"></i>
                        {{ __('New Filter') }}
                    </a>
                </div>
            @else
                <div class="card-toolbar">
                    <a href="{{ route('filters.create') }}" class="btn btn-sm btn-light-primary font-weight-bold">
                        <i class="la la-plus"></i>
                        {{ __('New Filter') }}
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

@endsection

@push('scripts')
    <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    {{$dataTable->scripts()}}
    <script>

        jQuery(document).ready(function() {
            $('#filters-table_filter').css('display', 'none');
        });

        (function(window,$){
            $.fn.dataTable.Buttons.defaults.dom.container.className = '';
            $.fn.dataTable.Buttons.defaults.dom.button.className = 'btn btn-sm btn-default font-weight-bold mr-2';
            var buttons = new $.fn.dataTable.Buttons(window.LaravelDataTables["filters-table"], {
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
                        jQuery('#filters-table').DataTable().draw(false);
                    });
                }
            });
        }

    </script>
@endpush
