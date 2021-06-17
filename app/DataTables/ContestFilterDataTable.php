<?php

namespace App\DataTables;

use App\Models\Contest;
use App\Models\ContestFilter;
use App\Models\Filter;
use Doctrine\DBAL\Driver\AbstractDB2Driver;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Column;
use App\DataTables\Traits\DatatableColumnSearch;

class ContestFilterDataTable extends DataTable
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
            ->editColumn('contest_id', function($contestfilter) {
                $contest = Contest::select('description')->where('id', $contestfilter->contest_id)->first();
                return $contest->description;

            })
            ->editColumn('filter_id', function($contestfilter){
                $filter = Filter::select('filter_name')->where('id', $contestfilter->filter_id)->first();
                return $filter->filter_name;
            })
            ->addColumn('action', function ($contestFilter) {
                return '<a class="btn btn-sm btn-clean btn-icon btn-icon-md" href="'. route('contest_filters.show', $contestFilter) .'" title="'. __('View') .'"><i class="la la-eye"></i></a>
                        <a href="'. route('contest_filters.edit', $contestFilter) .'" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="'. __('Edit') .'"><i class="la la-edit"></i></a>
                        <button class="btn btn-sm btn-clean btn-icon btn-icon-md delete-confirmation" data-destroy-form-id="destroy-form-'. $contestFilter->id .'" data-delete-url="'. route('contest_filters.destroy', $contestFilter) .'" onclick="destroyConfirmation(this)" title="'. __('Delete') .'"><i class="la la-trash"></i></button>';
            });
            //->editColumn('type', '{{ $this->typeLabel }}')
            /*->editColumn('type', function ($model) {
                              return  $model->typeLabel;
                          })*/
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ContestFilter $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ContestFilter $model)
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
            ->setTableId('contest_filters-table')
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
        $model = new ContestFilter();
        return [
            Column::make('contest_id')->title($model->getAttributeLabel('contest_id')),
            Column::make('filter_id')->title($model->getAttributeLabel('filter_id')),
            Column::make('date')->title($model->getAttributeLabel('date')),
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
        return 'contest_filters_' . date('YmdHis');
    }
}
