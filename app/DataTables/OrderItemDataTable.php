<?php

namespace App\DataTables;

use App\Models\OrderItem;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Column;
use App\DataTables\Traits\DatatableColumnSearch;

class OrderItemDataTable extends DataTable
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
            ->addColumn('action', function ($orderItem) {
                return '<a class="btn btn-sm btn-clean btn-icon btn-icon-md" href="'. route('order-items.show', $orderItem) .'" title="'. __('View') .'"><i class="la la-eye"></i></a>
                        <a href="'. route('order-items.edit', $orderItem) .'" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="'. __('Edit') .'"><i class="la la-edit"></i></a>
                        <button class="btn btn-sm btn-clean btn-icon btn-icon-md delete-confirmation" data-destroy-form-id="destroy-form-'. $orderItem->id .'" data-delete-url="'. route('order-items.destroy', $orderItem) .'" onclick="destroyConfirmation(this)" title="'. __('Delete') .'"><i class="la la-trash"></i></button>';
            });
            //->editColumn('type', '{{ $this->typeLabel }}')
            /*->editColumn('type', function ($model) {
                              return  $model->typeLabel;
                          })*/
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\OrderItem $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(OrderItem $model)
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
            ->setTableId('order_items-table')
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
        $model = new OrderItem();
        return [
            Column::make('entity_id')->title($model->getAttributeLabel('entity_id')),
            Column::make('order_id')->title($model->getAttributeLabel('order_id')),
            Column::make('product_id')->title($model->getAttributeLabel('product_id')),
            Column::make('cookie')->title($model->getAttributeLabel('cookie')),
            Column::make('name')->title($model->getAttributeLabel('name')),
            Column::make('quantity')->title($model->getAttributeLabel('quantity')),
            Column::make('price')->title($model->getAttributeLabel('price')),
            Column::make('notes')->title($model->getAttributeLabel('notes')),
            Column::make('iva')->title($model->getAttributeLabel('iva')),
            Column::make('start_date')->title($model->getAttributeLabel('start_date')),
            Column::make('end_date')->title($model->getAttributeLabel('end_date')),
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
        return 'order_items_' . date('YmdHis');
    }
}
