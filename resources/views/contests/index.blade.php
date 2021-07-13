@extends('layout.default')
<?php
view()->share('pageTitle', __('Contests'));
view()->share('hideSubHeader', true);
?>
@section('breadcrumbs')
    {{ Breadcrumbs::render('contests.index') }}
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
                    {{ __('Contests') }}
                </h3>
            </div>
        </div>
        <form>
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-lg-2 col-form-label">{{__('Number Announcement')}}</label>
                    <div class="col-lg-4">
                        <input class="form-control" type="text" id="num_announcement"/>
                    </div>
                    <label class="col-lg-2 col-form-label">{{__('Entity')}}</label>
                    <div class="col-lg-4">
                        <input class="form-control" type="text" id="entity"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-form-label">{{__('Description')}}</label>
                    <div class="col-lg-10">
                        <input class="form-control" type="text" id="description"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-form-label">{{__('CPV code')}}</label>
                    <div class="col-lg-4">
                        <input class="form-control" type="text" id="cpv"/>
                    </div>
                    <label class="col-lg-2 col-form-label">{{__('CPV Description')}}</label>
                    <div class="col-lg-4">
                        <input class="form-control" type="text" id="cpv_description"/>
                    </div>
                </div>
                <div class="form-group row">

                    {!! Form::label('type_act', \App\Models\Contest::getAttributeLabel('type_act'),['class'=>'col-2 col-form-label']) !!}
                    <div class="col-2">
                        {!! Form::select('type_act',\App\Models\Contest::getTypeActArray(), null, ['id' => 'type_act','class' => 'form-control '.($errors->has('type_act') ? 'is-invalid' : '')]) !!}
                        @error('type_act')
                        <div class="error invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {!! Form::label('type_model', \App\Models\Contest::getAttributeLabel('type_model'),['class'=>'col-2 col-form-label']) !!}
                    <div class="col-2">
                        {!! Form::select('type_model',\App\Models\Contest::getTypeModelArray(), null, ['id' => 'type_model','class' => 'form-control '.($errors->has('type_model') ? 'is-invalid' : '')]) !!}
                        @error('type_model')
                        <div class="error invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {!! Form::label('type_contract', \App\Models\Contest::getAttributeLabel('type_contract'),['class'=>'col-2 col-form-label']) !!}
                    <div class="col-2">
                        {!! Form::select('type_contract',\App\Models\Contest::getTypeContractArray(), null, ['id' => 'type_contract','class' => 'form-control '.($errors->has('type_contract') ? 'is-invalid' : '')]) !!}
                        @error('type_contract')
                        <div class="error invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
                <div class="form-group row">
                    <label for="example-date-input" class="col-2 col-form-label">{{__('Publication Date')}}</label>
                    <div class="col-3">
                        <input class="form-control datepicker" placeholder="dd/mm/aaaa" id="publication_date"/>
                    </div>
                    <div class="input-group-append col-1">
                        <span class="input-group-text">
                            <i class="la la-calendar"></i>
                        </span>
                    </div>
                    <label for="example-date-input" class="col-2 col-form-label">{{__('Between')}}</label>
                    <div class="col-3">
                        <input class="form-control datepicker" placeholder="dd/mm/aaaa" id="publication_date_between"/>
                    </div>
                    <div class="input-group-append col-1">
                        <span class="input-group-text">
                            <i class="la la-calendar"></i>
                        </span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-date-input" class="col-2 col-form-label">{{__('Limit Date')}}</label>
                    <div class="col-3">
                        <input class="form-control datepicker" placeholder="dd/mm/aaaa" id="deadline_date"/>
                    </div>
                    <div class="input-group-append col-1">
                        <span class="input-group-text">
                            <i class="la la-calendar"></i>
                        </span>
                    </div>
                    <label for="example-date-input" class="col-2 col-form-label">{{__('Between')}}</label>
                    <div class="col-3">
                        <input class="form-control datepicker" placeholder="dd/mm/aaaa" id="deadline_date_between"/>
                    </div>
                    <div class="input-group-append col-1">
                        <span class="input-group-text">
                            <i class="la la-calendar"></i>
                        </span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-2 ">{{__('Minimum Price')}}</label>
                    <div class="col-lg-4 ">
                        <input id="min_price_1" type="text" class="form-control text-center" value="0.00" name="demo0" placeholder="Select time"/>
                    </div>
                    <div class="checkbox-inline ml-4">
                        <label class="col-form-label  checkbox checkbox-lg">
                            <input type="checkbox" name="viewed_at" id="viewed_at"/>
                            <span></span>
                            {{__('Viewed contests')}}
                        </label>
                        <label class="col-form-label checkbox checkbox-lg">
                            <input type="checkbox" name="follow" id="follow"/>
                            <span></span>
                            {{__('Followed contests')}}
                        </label>
                        <label class="col-form-label checkbox checkbox-lg">
                            <input type="checkbox" name="notified" id="notified"/>
                            <span></span>
                            {{__('Notified contests')}}
                        </label>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-2">
                    </div>
                    <div class="col-10">
                        <button type="button" class="btn btn-success mr-2" id="pesquisa">{{__('Search')}}</button>
                        <button type="reset" class="btn btn-danger" id="reset">{{__('Reset')}}</button>
                    </div>
                </div>
            </div>
        </form>

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
    <script src="{{ asset('js/pages/date-inputs.js') }}" type="text/javascript"></script>
    {{$dataTable->scripts()}}
    <script>
        const table = $('#contests-table');

        jQuery(document).ready(function() {
            $('#contests-table_filter').css('display', 'none');
        });

        $('#publication_date').datepicker({
            format: 'dd-mm-yyyy'
        });
        $('#publication_date_between').datepicker({
            format: 'dd-mm-yyyy'
        });
        $('#deadline_date').datepicker({
            format: 'dd-mm-yyyy'
        });
        $('#deadline_date_between').datepicker({
            format: 'dd-mm-yyyy'
        });

        table.on('preXhr.dt',function (e,settings,data){
            data.num_announcement = $('#num_announcement').val();
            data.description = $('#description').val();
            data.entity = $('#entity').val();
            data.cpv = $('#cpv').val();
            data.cpv_description = $('#cpv_description').val();
            data.type_act = $('#type_act').val();
            data.type_model = $('#type_model').val();
            data.type_contract = $('#type_contract').val();
            data.publication_date = $('#publication_date').val();
            data.publication_date_between = $('#publication_date_between').val();
            data.deadline_date = $('#deadline_date').val();
            data.deadline_date_between = $('#deadline_date_between').val();
            data.min_price = $('#min_price_1').val();
            if ($('#viewed_at').prop('checked')) {
                data.viewed_at = true;
            }
            if ($('#follow').prop('checked')) {
                data.follow = true;
            }
            if ($('#notified').prop('checked')) {
                data.notified = true;
            }
        });

        $('#pesquisa').on('click', function(){
            table.DataTable().ajax.reload();
            return false;
        });

        $('#reset').on('click', function(){
            $('#num_announcement').val('');
            $('#description').val('');
            $('#entity').val('');
            $('#cpv').val('');
            $('#type_act').val('0');
            $('#type_model').val('0');
            $('#type_contract').val('0');
            $('#publication_date').val('');
            $('#publication_date_between').val('');
            $('#deadline_date').val('');
            $('#deadline_date_between').val('');
            $('#min_price_1').val('0.00');
            $('#viewed_at').prop('checked', false);
            $('#follow').prop('checked', false);
            $('#notified').prop('checked', false);
            table.DataTable().ajax.reload();
            return false;
        });

        $('#type_act').on('change',function (){
            table.DataTable().ajax.reload();
        });
        $('#type_model').on('change',function (){
            table.DataTable().ajax.reload();
        });
        $('#type_contract').on('change',function (){
            table.DataTable().ajax.reload();
        });

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

        $('#min_price_1, #min_price_2_1').TouchSpin({
            buttondown_class: 'btn btn-secondary',
            buttonup_class: 'btn btn-secondary',

            min: 0,
            max: 10000000000,
            step: 10000.0,
            decimals: 2,
            boostat: 5,
            maxboostedstep: 10,
        });

        (function(window,$){
            $.fn.dataTable.Buttons.defaults.dom.container.className = '';
            $.fn.dataTable.Buttons.defaults.dom.button.className = 'btn btn-sm btn-default font-weight-bold mr-2';
            var buttons = new $.fn.dataTable.Buttons(window.LaravelDataTables["contests-table"], {
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
                        jQuery('#contests-table').DataTable().draw(false);
                    });
                }
            });
        }

    </script>
@endpush
