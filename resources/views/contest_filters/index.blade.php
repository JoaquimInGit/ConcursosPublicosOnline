@extends('layout.default')
<?php
view()->share('pageTitle', __('Contest Filters'));
view()->share('hideSubHeader', true);
?>
@section('breadcrumbs')
    {{ Breadcrumbs::render('contest_filters.index') }}
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
                    {{ __('Notifications') }}
                </h3>
            </div>
        </div>
        <div class="card-body">
            <form>
                <div class="form-group row">
                    <label for="example-date-input" class="col-1 col-form-label">{{__('Date')}}</label>
                    <div class="col-3">
                        <input class="form-control datepicker" placeholder="dd/mm/aaaa" id="date"/>
                    </div>
                    <div class="input-group-append col-1">
                        <span class="input-group-text">
                            <i class="la la-calendar"></i>
                        </span>
                    </div>
                    <button type="button" class="btn btn-success mr-2" id="pesquisa">{{__('Pesquisar')}}</button>
                    <button type="reset" class="btn btn-danger" id="reset">{{__('Limpar')}}</button>
                </div>
            </form>
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
    <script src="{{ asset('js/pages/date-inputs.js') }}" type="text/javascript"></script>
    {{$dataTable->scripts()}}
    <script>
        const table = $('#contest_filters-table');

        $('#date').datepicker({
            format: 'dd-mm-yyyy'
        });

        table.on('preXhr.dt',function (e,settings,data){
            data.date = $('#date').val();
        });

        $('#pesquisa').on('click', function(){
            table.DataTable().ajax.reload();
            return false;
        })

        $('#reset').on('click', function(){
            $('#date').val('');
            table.DataTable().ajax.reload();
            return false;
        })

        (function(window,$){
            $.fn.dataTable.Buttons.defaults.dom.container.className = '';
            $.fn.dataTable.Buttons.defaults.dom.button.className = 'btn btn-sm btn-default font-weight-bold mr-2';
            var buttons = new $.fn.dataTable.Buttons(window.LaravelDataTables["contest_filters-table"], {
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
                        jQuery('#contest_filters-table').DataTable().draw(false);
                    });
                }
            });
        }

        function follow(data) {
            console.log(data)
            $.ajax({
                method: "POST",
                url: "{{route('contests.followDatatable')}}" ,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {data:data},
                success: function(response) {
                    console.log(response)
                    table.DataTable().ajax.reload();

                }
            })
        }

    </script>
@endpush
