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
                <span class="card-icon">
                    <i class="flaticon2-settings text-primary"></i>
                </span>
                <h3 class="card-label">
                    {{ __('Contests') }}
                </h3>
            </div>

        </div>
        <div class="card card-custom">
            <form>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-2 col-form-label">Numero Anúncio</label>
                        <div class="col-10">
                            <input class="form-control" type="text" id="num_announcement"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">Descrição</label>
                        <div class="col-10">
                            <input class="form-control" type="text" id="description"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">Entidade</label>
                        <div class="col-10">
                            <input class="form-control" type="text" id="entity"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">Tipo de Ato</label>
                        <div class="col-2">
                            <select class="form-control" id="type_act">
                                <option value="0">Todos</option>
                                <option value="1">Anúncio de procedimento</option>
                                <option value="2">Anúncio de concurso urgente</option>
                                <option value="3">Declaração de retificação de anúncio</option>
                                <option value="4">Aviso de prorrogação de prazo</option>
                            </select>
                        </div>
                        <label class="col-2 col-form-label">Tipo de Modelo</label>
                        <div class="col-2">
                            <select class="form-control" id="type_model">
                                <option value="0">Todos</option>
                                <option value="1">Concursos público</option>
                                <option value="2">Concursos público urgente</option>
                                <option value="3">Concursos limitado por prévia qualificação</option>
                                <option value="4">Procedimento de negociação</option>
                                <option value="5">Diálogo concorrencial</option>
                                <option value="6">Concurso de concepção</option>
                                <option value="7">Anúncio simplificado</option>
                                <option value="8">Instituição de sistema de qualificação</option>
                                <option value="9">Intenção de celebração de empreitadas de obras publicas por concessionários que não sejam entidades adjudicantes</option>
                                <option value="10">Parceria para a inovação</option>
                                <option value="11">Concurso de ideias</option>
                                <option value="12">Instituição de sistema de aquisição dinâmico</option>
                                <option value="13">Hasta Pública de Alienaçãode Bens Móveis</option>
                                <option value="14">Aquisição de Serviços Sociais e de Outros Serviços Específicos</option>
                                <option value="15">Anúncio de Adjudicação de Aquisição de Serviços Sociais e de Outros Serviços Específicos</option>
                            </select>
                        </div>
                        <label class="col-2 col-form-label">Tipo de Contrato</label>
                        <div class="col-2">
                            <select class="form-control" id="type_contract">
                                <option value="0">Todos</option>
                                <option value="1">Aquisição de bens móveis</option>
                                <option value="2">Aquisição de serviços</option>
                                <option value="3">Concessão de obras públicas</option>
                                <option value="4">Concessão de serviços públicos</option>
                                <option value="5">Empreitadas de obras públicas</option>
                                <option value="6">Localização de bens móveis</option>
                                <option value="7">Sociedade</option>
                                <option value="8">Outros</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-date-input" class="col-2 col-form-label">Data de Publicação</label>
                        <div class="col-4">
                            <input class="form-control" type="date" value="<?php #echo date("Y-m-d"); ?>" id="publication_date"/>
                        </div>
                        <label for="example-date-input" class="col-2 col-form-label">Entre</label>
                        <div class="col-4">
                            <input class="form-control" type="date" value="<?php #echo date("Y-m-d"); ?>" id="publication_date_between"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-date-input" class="col-2 col-form-label">Data Limite</label>
                        <div class="col-4">
                            <input class="form-control" type="date" id="deadline_date"/>
                        </div>
                        <label for="example-date-input" class="col-2 col-form-label">Entre</label>
                        <div class="col-4">
                            <input class="form-control" type="date" id="deadline_date_between"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2 col-sm-12">Preço Minimo</label>
                        <div class="col-lg-3 col-md-9 col-sm-12">
                            <input id="min_price_1" type="text" class="form-control text-center" value="100000" name="demo0" placeholder="Select time"/>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-2">
                        </div>
                        <div class="col-10">
                            <button type="button" class="btn btn-success mr-2" id="pesquisa">Pesquisar</button>
                            <button type="reset" class="btn btn-danger" id="reset">Reset</button>
                        </div>
                    </div>
                </div>
            </form>
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
        const table = $('#contests-table');

        jQuery(document).ready(function() {
            $('#contests-table_filter').css('display', 'none');
        });

        table.on('preXhr.dt',function (e,settings,data){
            data.num_announcement = $('#num_announcement').val();
            data.description = $('#description').val();
            data.entity = $('#entity').val();
            data.type_act = $('#type_act').val();
            data.type_model = $('#type_model').val();
            data.type_contract = $('#type_contract').val();
            data.publication_date = $('#publication_date').val();
            data.publication_date_between = $('#publication_date_between').val();
            data.deadline_date = $('#deadline_date').val();
            data.deadline_date_between = $('#deadline_date_between').val();
            data.min_price = $('#min_price_1').val();

        });

        $('#pesquisa').on('click', function(){
            table.DataTable().ajax.reload();
            return false;
        })
        $('#reset').on('click', function(){
            table.on('preXhr.dt',function (e,settings,data){
                data.num_announcement = '';
                data.description = '';
                data.entity = '';
                data.type_act = '';
                data.type_model = '';
                data.type_contract = '';
                data.publication_date = '';
                data.publication_date_between = '';
                data.deadline_date = '';
                data.deadline_date_between = '';
                data.min_price_1 = '';
            });
            table.DataTable().ajax.reload();
            return false;
        })

        $('#type_act').on('change',function (){
            table.DataTable().ajax.reload();
        })
        $('#type_model').on('change',function (){
            table.DataTable().ajax.reload();
        })
        $('#type_contract').on('change',function (){
            table.DataTable().ajax.reload();
        })
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
