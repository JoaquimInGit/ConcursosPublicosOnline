<?php

namespace App\DataTables;

use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\Models\Role;

class RoleDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $datatable =datatables()
            ->eloquent($query)
            ->editColumn('created_at', '{!! date(\'d-m-Y H:i:s\', strtotime($created_at)) !!}')
            //->editColumn('created_at', '{{ Carbon\Carbon::parse(created_at)->toDateTimeString() }}');
            ->addColumn('action', function ($role) {
                return '<a class="btn btn-sm btn-clean btn-icon btn-icon-md" href="'. route('roles.show', $role) .'" title="'. __('View') .'"><i class="la la-eye"></i></a>
                        <a href="'. route('roles.edit', $role) .'" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="'. __('Edit') .'"><i class="la la-edit"></i></a>
                        <button class="btn btn-sm btn-clean btn-icon btn-icon-md delete-confirmation" data-destroy-form-id="destroy-form-'. $role->id .'" data-delete-url="'. route('roles.destroy', $role) .'" onclick="destroyConfirmation(this)" title="'. __('Delete') .'"><i class="la la-trash"></i></button>';

            });
        return $datatable;
    }

    /**
     * Get query source of dataTable.
     *
     * @param Role $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Role $model)
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
            ->setTableId('roles-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>><'table-responsive'rt>ip") // Bfrtip
            ->orderBy(1)
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
        $columns = [
            Column::make('id'),
            Column::make('name'),
            //Column::make('guard_name'),
            Column::make('created_at'),
            //Column::make('updated_at'),


        ];
        $columns[]=Column::computed('action')
            ->exportable(false)
            ->printable(false)
            ->width(120)
            ->addClass('text-center');

        return $columns;
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Role_' . date('YmdHis');
    }
}
