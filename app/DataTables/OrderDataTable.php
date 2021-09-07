<?php

namespace App\DataTables;

use App\Models\Order;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Column;
use App\DataTables\Traits\DatatableColumnSearch;

class OrderDataTable extends DataTable
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
            ->addColumn('action', function ($order) {
                return '<a class="btn btn-sm btn-clean btn-icon btn-icon-md" href="'. route('orders.show', $order) .'" title="'. __('View') .'"><i class="la la-eye"></i></a>
                        <a href="'. route('orders.edit', $order) .'" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="'. __('Edit') .'"><i class="la la-edit"></i></a>
                        <button class="btn btn-sm btn-clean btn-icon btn-icon-md delete-confirmation" data-destroy-form-id="destroy-form-'. $order->id .'" data-delete-url="'. route('orders.destroy', $order) .'" onclick="destroyConfirmation(this)" title="'. __('Delete') .'"><i class="la la-trash"></i></button>';
            });
            //->editColumn('type', '{{ $this->typeLabel }}')
            /*->editColumn('type', function ($model) {
                              return  $model->typeLabel;
                          })*/
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Order $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Order $model)
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
            ->setTableId('orders-table')
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
        $model = new Order();
        return [
            Column::make('entity_id')->title($model->getAttributeLabel('entity_id')),
            Column::make('user_id')->title($model->getAttributeLabel('user_id')),
            Column::make('name')->title($model->getAttributeLabel('name')),
            Column::make('email')->title($model->getAttributeLabel('email')),
            Column::make('address')->title($model->getAttributeLabel('address')),
            Column::make('zip_code')->title($model->getAttributeLabel('zip_code')),
            Column::make('mobile_phone')->title($model->getAttributeLabel('mobile_phone')),
            Column::make('nif')->title($model->getAttributeLabel('nif')),
            Column::make('coupon')->title($model->getAttributeLabel('coupon')),
            Column::make('discount')->title($model->getAttributeLabel('discount')),
            Column::make('sub_total')->title($model->getAttributeLabel('sub_total')),
            Column::make('iva_value')->title($model->getAttributeLabel('iva_value')),
            Column::make('payment_method')->title($model->getAttributeLabel('payment_method')),
            Column::make('notes')->title($model->getAttributeLabel('notes')),
            Column::make('mb_entity')->title($model->getAttributeLabel('mb_entity')),
            Column::make('mb_ref')->title($model->getAttributeLabel('mb_ref')),
            Column::make('mb_limit_date')->title($model->getAttributeLabel('mb_limit_date')),
            Column::make('mbway_ref')->title($model->getAttributeLabel('mbway_ref')),
            Column::make('mbway_alias')->title($model->getAttributeLabel('mbway_alias')),
            Column::make('payment_ref')->title($model->getAttributeLabel('payment_ref')),
            Column::make('invoice_id')->title($model->getAttributeLabel('invoice_id')),
            Column::make('invoice_link')->title($model->getAttributeLabel('invoice_link')),
            Column::make('payment_limit_date')->title($model->getAttributeLabel('payment_limit_date')),
            Column::make('invoice_status')->title($model->getAttributeLabel('invoice_status')),
            Column::make('status')->title($model->getAttributeLabel('status')),
            Column::computed('action')
                ->exportable(true)
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
        return 'orders_' . date('YmdHis');
    }
}
