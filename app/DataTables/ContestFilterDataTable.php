<?php

namespace App\DataTables;

use App\Models\Contest;
use App\Models\ContestEntity;
use App\Models\ContestFilter;
use App\Models\Entity;
use App\Models\Filter;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Doctrine\DBAL\Driver\AbstractDB2Driver;
//use mysql_xdevapi\Exception;
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
            ->editColumn('date', function ($contestfilter){
                return !empty($contestfilter->date) ? Carbon::Parse($contestfilter->date)->format('d-m-Y') : '';
            })
           // ->editColumn('created_at', '{!! date(\'d-m-Y H:i:s\', strtotime($created_at)) !!}')
            ->editColumn('contest_id', function($contestfilter) {
                $contest = Contest::select('description')->where('id', $contestfilter->contest_id)->first();
                return $contest->description;
            })
            ->editColumn('filter_id', function($contestfilter){
                $filter = Filter::select('filter_name')->where('id', $contestfilter->filter_id)->first();
                return $filter->filter_name;
            })
            ->editColumn('entity', function ($contestfilter) {
                if(auth()->user()->can('accessAsUser')){
                    $filter = Filter::where('id', $contestfilter->filter_id)->first();
                    $entity = Entity::where('id', $filter->entity_id)->first();
                    $user = User::where('id',$entity->user_id)->first();
                    return $user->email;
                }else{
                    $filter = Filter::where('id', $contestfilter->filter_id)->first();
                    $entity = Entity::where('id', $filter->entity_id)->first();
                    return $entity->name;
                }
            })

            ->addColumn('action', function ($contestfilter) {
                $contest = Contest::find($contestfilter->contest_id);
              //  $contest = Contest::where('id',$contestfilter->contest_id);
               // \Debugbar::error($contest);
                if(auth()->user()->can('accessAsUser')){
                   //$contest = Contest::first("id", $contestfilter->contest_id);
                    $entity = Entity::getCurrentEntity();
                    //\Debugbar::error($entity);
                   // $contestentity = ContestEntity::getRegistoId($contest->contests_id,$entity)->first();
                    $contestentity = ContestEntity::getRegisto($contest,$entity)->first();
                  // \Debugbar::error(!empty($contestentity));
                   \Debugbar::error($contestentity);
                    if(!empty($contestentity) && $contestentity->follow == 1){
                        return '<a class="btn btn-sm btn-clean btn-icon btn-icon-md" href="'. route('contests.show', $contest) .'" title="'. __('View') .'"><i class="la la-eye"></i></a>'.
                            '<a class="btn btn-sm btn-clean btn-icon btn-icon-md follow" onclick="follow('.$contestfilter->contest_id.')" title="'. __('Follow').'"> <i class="la la-star" style="color:blue"></i></a>';
                    }else{
                        return '<a class="btn btn-sm btn-clean btn-icon btn-icon-md" href="'. route('contests.show', $contest) .'" title="'. __('View') .'"><i class="la la-eye"></i></a>'.
                            '<a class="btn btn-sm btn-clean btn-icon btn-icon-md follow" onclick="follow('.$contestfilter->contest_id.')" title="'. __('Follow').'"> <i class="la la-star" ></i></a>';
                    }
                }else{
                    return '<a class="btn btn-sm btn-clean btn-icon btn-icon-md" href="'. route('contests.show', $contest) .'" title="'. __('View') .'"><i class="la la-eye"></i></a>
                        <a class="btn btn-sm btn-clean btn-icon btn-icon-md" href="'. route('contests.edit', $contest) .'"  title="'. __('Edit') .'"><i class="la la-edit"></i></a>
                        <button class="btn btn-sm btn-clean btn-icon btn-icon-md delete-confirmation" data-destroy-form-id="destroy-form-'. $contestfilter->contest_id .'" data-delete-url="'. route('contests.destroy', $contest) .'" onclick="destroyConfirmation(this)" title="'. __('Delete') .'"><i class="la la-trash"></i></button>';
                }

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
       // $date = $this->request()->get('date');
        $query = $model->newQuery();

      /*  if(!empty($date)) {
            $query = $query->where('date', 'LIKE', Carbon::Parse($date)->format('Y-m-d'));
        }*/

        if(auth()->user()->can('accessAsUser')){
            try{
                $entity = $model->getEntity();
                $filters = $model->getFiltersEntity($entity);
                //$query = $query->where('filter_id', $filter);
                $query = $query->where(function($q) use ($filters){
                    foreach ($filters as $filter) {
                        $q->orWhere('filter_id', $filter->id);
                    }
                });
            }catch(Exception $e){

            }

           ///Debugbar($query);
        }
        return $query;
        //return $model->newQuery();



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
            ->pageLength(50)
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
        if(auth()->user()->can('accessAsUser')){
            return[
                Column::make('contest_id')->title($model->getAttributeLabel(__('Contest'))),
                Column::make('filter_id')->title($model->getAttributeLabel(__('Filter'))),
                Column::make('entity')->title(__('Enviado para')),
                Column::make('date')->title($model->getAttributeLabel(__('Date'))),
                Column::computed('action')
                    ->exportable(false)
                    ->printable(false)
                    ->width(120)
                    ->addClass('text-center')
                    ->title(__('Action')),
                ];
        }else{
            return[
                Column::make('contest_id')->title($model->getAttributeLabel(__('Contest'))),
                Column::make('filter_id')->title($model->getAttributeLabel(__('Filter'))),
                Column::make('entity')->title(__('Entity')),
                Column::make('date')->title($model->getAttributeLabel(__('Date'))),
                Column::computed('action')
                    ->exportable(false)
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
        return 'contest_filters_' . date('YmdHis');
    }
}
