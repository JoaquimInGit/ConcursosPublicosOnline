<?php

namespace App\DataTables;

use App\Models\Entity;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Column;
use App\DataTables\Traits\DatatableColumnSearch;

class EntityDataTable extends DataTable
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
            ->addColumn('action', function ($entity) {
                return '<a class="btn btn-sm btn-clean btn-icon btn-icon-md" href="'. route('entities.show', $entity) .'" title="'. __('View') .'"><i class="la la-eye"></i></a>
                        <a href="'. route('entities.edit', $entity) .'" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="'. __('Edit') .'"><i class="la la-edit"></i></a>
                        <button class="btn btn-sm btn-clean btn-icon btn-icon-md delete-confirmation" data-destroy-form-id="destroy-form-'. $entity->id .'" data-delete-url="'. route('entities.destroy', $entity) .'" onclick="destroyConfirmation(this)" title="'. __('Delete') .'"><i class="la la-trash"></i></button>';
            });
            //->editColumn('type', '{{ $this->typeLabel }}')
            /*->editColumn('type', function ($model) {
                              return  $model->typeLabel;
                          })*/
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Entity $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Entity $model)
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
            ->setTableId('entities-table')
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
        $model = new Entity();
        return [
            Column::make('user_id')->title($model->getAttributeLabel('user_id')),
            Column::make('name')->title($model->getAttributeLabel('name')),
            Column::make('country')->title($model->getAttributeLabel('country')),
            Column::make('district')->title($model->getAttributeLabel('district')),
            Column::make('address')->title($model->getAttributeLabel('address')),
            Column::make('postal_code')->title($model->getAttributeLabel('postal_code')),
            Column::make('mobile_phone')->title($model->getAttributeLabel('mobile_phone')),
            Column::make('nif')->title($model->getAttributeLabel('nif')),
            Column::make('cae')->title($model->getAttributeLabel('cae')),
            Column::make('cae_secundario')->title($model->getAttributeLabel('cae_secundario')),
            Column::make('website')->title($model->getAttributeLabel('website')),
            Column::make('email_entity')->title($model->getAttributeLabel('email_entity')),
            Column::make('status')->title($model->getAttributeLabel('status')),
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
        return 'entities_' . date('YmdHis');
    }
}
