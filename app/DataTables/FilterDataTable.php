<?php

namespace App\DataTables;

use App\Models\Filter;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Column;
use App\DataTables\Traits\DatatableColumnSearch;

class FilterDataTable extends DataTable
{
    use DatatableColumnSearch;

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('created_at', '{!! date(\'d-m-Y H:i:s\', strtotime($created_at)) !!}')
            ->addColumn('action', function ($filter) {
                return '<a class="btn btn-sm btn-clean btn-icon btn-icon-md" href="'. route('filters.show', $filter) .'" title="'. __('View') .'"><i class="la la-eye"></i></a>
                        <a href="'. route('filters.edit', $filter) .'" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="'. __('Edit') .'"><i class="la la-edit"></i></a>
                        <button class="btn btn-sm btn-clean btn-icon btn-icon-md delete-confirmation" data-destroy-form-id="destroy-form-'. $filter->id .'" data-delete-url="'. route('filters.destroy', $filter) .'" onclick="destroyConfirmation(this)" title="'. __('Delete') .'"><i class="la la-trash"></i></button>';
            });
            //->editColumn('type', '{{ $this->typeLabel }}')
            /*->editColumn('type', function ($model) {
                              return  $model->typeLabel;
                          })*/
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Filter $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Filter $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('filters-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>><'table-responsive'rt>ip") // Bfrtip
             //   ->searchCols([ 'type' => "(1|2)"])
            ->initComplete($this->searchJS)
            ->orderBy([0, 'desc'])
            ->parameters([
                'buttons' => [],
                'language' => [
                    'url' => asset('lang/pt/datatable.json')
                ]
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        $model = new Filter();
        return [
            Column::make('entity_id')->title($model->getAttributeLabel('entity_id')),
            Column::make('filter_name')->title($model->getAttributeLabel('filter_name')),
            Column::make('description_words')->title($model->getAttributeLabel('description_words')),
            Column::make('contest_entity')->title($model->getAttributeLabel('contest_entity')),
            Column::make('district')->title($model->getAttributeLabel('district')),
            Column::make('min_price')->title($model->getAttributeLabel('min_price')),
            Column::make('max_price')->title($model->getAttributeLabel('max_price')),
            Column::make('cpv')->title($model->getAttributeLabel('cpv')),
            Column::make('type_act')->title($model->getAttributeLabel('type_act')),
            Column::make('type_model')->title($model->getAttributeLabel('type_model')),
            Column::make('type_contract')->title($model->getAttributeLabel('type_contract')),
            Column::make('filter_status')->title($model->getAttributeLabel('filter_status')),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(120)
                ->addClass('text-center')
                ->title(__('Action')),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'filters_' . date('YmdHis');
    }
}
