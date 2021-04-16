<?php

namespace App\DataTables;

use App\Models\User;
use Carbon\Carbon;
use DebugBar\DebugBar;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        //return datatables()->eloquent($query);
        $datatable =datatables()
            ->eloquent($query)
            //->addColumn('action', 'users.action');
            ->editColumn('created_at', '{!! date(\'d-m-Y H:i:s\', strtotime($created_at)) !!}')
            //->editColumn('email_verified_at', '{!! date(\'d-m-Y H:i:s\', strtotime($email_verified_at)) !!}')
            ->editColumn('email_verified_at', '{{ Carbon\Carbon::parse($email_verified_at)->toDateTimeString() }}')
            ->addColumn('role',  function ($user) {
                return $user->roles_label;
            })
            /*->addColumn('first_name', function ($user) {
                return $user->first_name;
            })
            ->addColumn('intro', 'Hi {{$first_name}}!');*/

            ->addColumn('action', function ($user) {
                   //return '<a href="#edit-'.$user->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                   if(auth()->user()->id != $user->id && (auth()->user()->can('adminFullApp') || (auth()->user()->can('adminApp') && !$user->can('adminFullApp'))))
                        $impersonateHtml = '<a class="dropdown-item" href="'. route('impersonate', $user->id) .'"><i class="la la-users"></i> '. __('Impersonate') .'</a>';
                   else
                       $impersonateHtml = '';
                   return '<span class="dropdown">
                            <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true"><i class="la la-ellipsis-h"></i></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="'. route('users.show', $user) .'"><i class="la la-eye"></i> '. __('View') .'</a>'.
                                $impersonateHtml
                                .'<button class="dropdown-item delete-confirmation"  data-destroy-form-id="destroy-form-'. $user->id .'" data-delete-url="'. route('users.destroy', $user) .'" onclick="destroyConfirmation(this)"><i class="la la-trash"></i> '. __('Delete') .'</button>
                                <form id="destroy-form-'. $user->id .'" action="'. route('users.destroy', $user) .'" method="POST" style="display: none;">
                                    '.csrf_field().'
                                    '.method_field('DELETE').'
                                </form>
                            </div>
                        </span>
                        <a href="'. route('users.edit', $user) .'" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="'. __('Edit') .'"><i class="la la-edit"></i></a>';
               });
        return $datatable;

    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
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
            ->setTableId('users-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>><'table-responsive'rt>ip") // Bfrtip
            ->orderBy(1)
            ->parameters([
                'buttons'      => [/*'export', 'print'*/],
                /*'language' => [
                    'url' => asset('lang/pt/datatable.json')
                ]*/
            ]);
               /*     ->buttons(
                        Button::make('create'),
                        /*Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')*//*
                    );*/
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
            Column::make('email'),
            Column::make('email_verified_at'), // ->title('teste')
            Column::make('created_at'),
            Column::make('role')->orderable(false),
            //Column::make('first_name'),
            //Column::make('intro')->orderable(false),
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
        return 'Users_' . date('YmdHis');
    }
}
