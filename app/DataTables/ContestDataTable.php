<?php

namespace App\DataTables;

use App\Models\Contest;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Column;
use App\DataTables\Traits\DatatableColumnSearch;

class ContestDataTable extends DataTable
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
            ->addColumn('action', function ($contest) {
                return '<a class="btn btn-sm btn-clean btn-icon btn-icon-md" href="'. route('contests.show', $contest) .'" title="'. __('View') .'"><i class="la la-eye"></i></a>
                        <a href="'. route('contests.edit', $contest) .'" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="'. __('Edit') .'"><i class="la la-edit"></i></a>
                        <button class="btn btn-sm btn-clean btn-icon btn-icon-md delete-confirmation" data-destroy-form-id="destroy-form-'. $contest->id .'" data-delete-url="'. route('contests.destroy', $contest) .'" onclick="destroyConfirmation(this)" title="'. __('Delete') .'"><i class="la la-trash"></i></button>';
            });
            //->editColumn('type', '{{ $this->typeLabel }}')
            /*->editColumn('type', function ($model) {
                              return  $model->typeLabel;
                          })*/
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Contest $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Contest $model)
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
            ->setTableId('contests-table')
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
        $model = new Contest();
        return [
            Column::make('num_announcement')->title($model->getAttributeLabel('num_announcement')),
            Column::make('description')->title($model->getAttributeLabel('description')),
            Column::make('entity')->title($model->getAttributeLabel('entity')),
            Column::make('type_act')->title($model->getAttributeLabel('type_act')),
            Column::make('type_model')->title($model->getAttributeLabel('type_model')),
            Column::make('type_contract')->title($model->getAttributeLabel('type_contract')),
            Column::make('price')->title($model->getAttributeLabel('price')),
            Column::make('publication_date')->title($model->getAttributeLabel('publication_date')),
            Column::make('deadline')->title($model->getAttributeLabel('deadline')),
            Column::make('state')->title($model->getAttributeLabel('state')),
            Column::make('republic_diary')->title($model->getAttributeLabel('republic_diary')),
            Column::make('cpv')->title($model->getAttributeLabel('cpv')),
            Column::make('cpv_description')->title($model->getAttributeLabel('cpv_description')),
            Column::make('procedure_parts')->title($model->getAttributeLabel('procedure_parts')),
            Column::make('pdf_content')->title($model->getAttributeLabel('pdf_content')),
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
        return 'contests_' . date('YmdHis');
    }
}
