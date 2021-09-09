<?php

namespace App\DataTables;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Carbon\Carbon;
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
            ->editColumn('entity', function($orderItem) {
                $entity = !empty($orderItem->order->entity) ? $orderItem->order->entity->name : "";
                return $entity;
            })
            ->editColumn('product_id', function($orderItem) {
                $product = Product::where('id', $orderItem->product_id)->first();
                return $product->description;
            })
            ->editColumn('iva', function($orderItem) {
                return number_format($orderItem->iva, 2, ',', '.').'€';
            })
            ->editColumn('start_date', function ($orderItem){
                return !empty($orderItem->start_date) ? Carbon::Parse($orderItem->start_date)->format('d-m-Y') : '';
            })
            ->editColumn('end_date', function ($orderItem){
                return !empty($orderItem->end_date) ? Carbon::Parse($orderItem->end_date)->format('d-m-Y') : '';
            })
            /*->editColumn('invoice_status', function ($orderItem) {

                \Debugbar::error($orderItem->order);
                if($orderItem->order->invoice_status == Order::INVOICE_STATUS_WAITING_EMISSION && auth()->user()->can('adminApp')){
                    return  $orderItem->order->invoiceStatusLabel.'<br><a class="btn btn-sm btn-primary" href="#" onclick="event.preventDefault(); document.getElementById(\'generate-invoice-'.$orderItem->order->id.'\').submit();">Faturar</a>
                      <form id="generate-invoice-'.$orderItem->order->id.'" action="'.route('orders.generate_invoice', $orderItem->order).'" method="POST" style="display: none;">
                          '.csrf_field().'
                      </form>';
                }else {

                    $html =  $orderItem->order->invoiceStatusLabel;
                    if(!empty($model->invoice_link)){
                        $html.='<br><a class="btn btn-sm btn-light" href="'.$orderItem->order->invoice_link.'" target="_blank">'.__('Download').'</a>';
                    }
                    return $html;
                }
            })*/
            ->editColumn('status', function ($orderItem){
                if($orderItem->status == 1){
                    return __('Waiting Payment');
                }else if($orderItem->status == 2){
                    return __('Payed');
                }
            })
            ->addColumn('action', function ($orderItem) {
                if(auth()->user()->can('accessAsUser')){
                    if($orderItem->status == 1){
                        \Debugbar::error('waiting');
                        return '<a class="btn btn-primary" href="'. route('orders.show', $orderItem->order_id) .'">'. __('Pay') .'</a>';
                    }elseif($orderItem->status == 2){
                        if(!empty($orderItem->invoice_link)){
                            \Debugbar::error('payed com fatura');
                            return '<a class="btn btn-primary" href="'. $orderItem->invoice_link .'">'. __('Ver Fatura') .'</a><a class="btn" href="'. route('orders.show', $orderItem->order_id) .'">'. __('Detalhes') .'</a>';
                        }else{
                            \Debugbar::error('payed sem fatura');
                            return '<a class="btn" href="'. route('orders.show', $orderItem->order_id) .'">'. __('Detalhes') .'</a>';
                        }
                    }else{
                        \Debugbar::error('canceled');
                        return '';
                    }

                }else{
                    return '<a class="btn btn-sm btn-clean btn-icon btn-icon-md" href="'. route('orders.show', $orderItem->order_id) .'" title="'. __('View') .'"><i class="la la-eye"></i></a>
                            <a class="btn btn-sm btn-clean btn-icon btn-icon-md" href="'. route('orders.edit', $orderItem->order_id) .'"  title="'. __('Edit') .'"><i class="la la-edit"></i></a>
                        <button class="btn btn-sm btn-clean btn-icon btn-icon-md delete-confirmation" data-destroy-form-id="destroy-form-'. $orderItem->order_id .'" data-delete-url="'. route('orders.destroy', $orderItem->order_id) .'" onclick="destroyConfirmation(this)" title="'. __('Delete') .'"><i class="la la-trash"></i></button>';
                }
            })->escapeColumns([]);
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
        $query = $model->newQuery();
        if(auth()->user()->can('accessAsUser')){
            $entity = $model->getEntity();
            $query = $query->where('entity_id',$entity);
        }
        return $query;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        if(auth()->user()->can('manageUsers')){
            return $this->builder()
                ->setTableId('order_items-table')
                ->columns($this->getColumns())
                ->minifiedAjax()
                ->dom("<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>><'table-responsive'rt>ip") // Bfrtip
                //   ->searchCols([ 'type' => "(1|2)"])
                ->initComplete($this->searchJS)
                ->orderBy([6, 'desc'])
                ->parameters([
                    'buttons' => [],
                    'language' => [
                        'url' => asset('lang/pt/datatable.json')
                    ]
                ]);
        }else{
            return $this->builder()
                ->setTableId('order_items-table')
                ->columns($this->getColumns())
                ->minifiedAjax()
                ->dom("<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>><'table-responsive'rt>ip") // Bfrtip
                //   ->searchCols([ 'type' => "(1|2)"])
                ->initComplete($this->searchJS)
                ->orderBy([5, 'desc'])
                ->parameters([
                    'buttons' => [],
                    'language' => [
                        'url' => asset('lang/pt/datatable.json')
                    ]
                ]);
        }

    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        $model = new OrderItem();
        if(auth()->user()->can('manageUsers')){
            return [
                Column::make('entity')->title(__('Entity')),
                Column::make('product_id')->title(__('Product')),
                Column::make('iva')->title(__('Total')),
                Column::make('start_date')->title($model->getAttributeLabel('start_date')),
                Column::make('end_date')->title($model->getAttributeLabel('end_date')),
                Column::make('created_at')->title($model->getAttributeLabel('created_at')),
                /*Column::make('invoice_status')->title($model->getAttributeLabel('invoice_status')),*/
                Column::make('status')->title($model->getAttributeLabel('status')),
                Column::computed('action')
                    ->exportable(true)
                    ->printable(false)
                    ->width(120)
                    ->addClass('text-center')
                    ->title(__('Action')),
            ];
        }else{
            return [
                Column::make('product_id')->title(__('Product')),
                Column::make('iva')->title(__('Total')),
                Column::make('start_date')->title($model->getAttributeLabel('start_date')),
                Column::make('end_date')->title($model->getAttributeLabel('end_date')),
                Column::make('status')->title($model->getAttributeLabel('status')),
                Column::computed('action')
                    ->exportable(true)
                    ->printable(false)
                    ->width(120)
                    ->addClass('text-center')
                    ->title(__('Action')),
            ];
        }

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
