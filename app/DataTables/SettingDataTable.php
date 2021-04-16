<?php

namespace App\DataTables;

use App\Models\Setting;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use App\DataTables\Traits\DatatableColumnSearch;


class SettingDataTable extends DataTable
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
            //->editColumn('type', '{{ $this->typeLabel }}')
            ->editColumn('created_at', '{!! date(\'d-m-Y H:i:s\', strtotime($created_at)) !!}')
            ->editColumn('type', function ($model) {
                return  $model->typeLabel;
            })
            ->addColumn('action', function ($setting) {
                return '<a class="btn btn-sm btn-clean btn-icon btn-icon-md" href="'. route('settings.show', $setting) .'" title="'. __('View') .'"><i class="la la-eye"></i></a>
                        <a href="'. route('settings.edit', $setting) .'" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="'. __('Edit') .'"><i class="la la-edit"></i></a>
                        <button class="btn btn-sm btn-clean btn-icon btn-icon-md delete-confirmation" data-destroy-form-id="destroy-form-'. $setting->id .'" data-delete-url="'. route('settings.destroy', $setting) .'" onclick="destroyConfirmation(this)" title="'. __('Delete') .'"><i class="la la-trash"></i></button>';
            })->filterColumn('group', function($query, $keyword) {
                $query->where('group', 'like', "%{$keyword}%");
            });
            /*->filterColumn('type', function($query, $keyword) {
                //$sql = "CONCAT(users.first_name,'-',users.last_name)  like ?";
                //$query->whereRaw($sql, ["%{$keyword}%"]);
                $query->where('type', 1);
            });*/
    }

    /**
     * Get query source of dataTable.
     *
     * @param Setting $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Setting $model)
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
            ->setTableId('settings-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>><'table-responsive'rt>ip") // Bfrtip
             //   ->searchCols([ 'type' => "(1|2)"])
            ->initComplete($this->searchJS)
            ->orderBy([0, 'desc'])
            ->parameters([
                'buttons' => [],
                /*'language' => [
                    'url' => asset('lang/pt/datatable.json')
                ]*/
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            //Column::make('id'),
            Column::make('type')
                ->attributes(['data-options' => json_encode(Setting::getTypeArray())]),
            Column::make('group'),
            Column::make('name'),
            //Column::make('slug'),
            //Column::make('options'),
            Column::make('value'),
            //Column::make('order'),
            //Column::make('created_at'),
            //Column::make('updated_at'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(120)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Setting_' . date('YmdHis');
    }
}
