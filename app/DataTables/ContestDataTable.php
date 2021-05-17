<?php

namespace App\DataTables;

use App\Models\Contest;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Column;
use App\DataTables\Traits\DatatableColumnSearch;

class ContestDataTable extends DataTable
{
    //use DatatableColumnSearch;

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
                if(auth()->user()->can('accessAsUser')){
                    return '<a class="btn btn-sm btn-clean btn-icon btn-icon-md" href="'. route('contests.show', $contest) .'" title="'. __('View') .'"><i class="la la-eye"></i></a>
                        <a class="btn btn-sm btn-clean btn-icon btn-icon-md" href="'. route('contests.show', $contest) .'" title="'. __('Follow') .'"><i class="la la-star"></i></a>';
                }else{
                    return '<a class="btn btn-sm btn-clean btn-icon btn-icon-md" href="'. route('contests.show', $contest) .'" title="'. __('View') .'"><i class="la la-eye"></i></a>
                        <a class="btn btn-sm btn-clean btn-icon btn-icon-md" href="'. route('contests.edit', $contest) .'"  title="'. __('Edit') .'"><i class="la la-edit"></i></a>
                        <button class="btn btn-sm btn-clean btn-icon btn-icon-md delete-confirmation" data-destroy-form-id="destroy-form-'. $contest->id .'" data-delete-url="'. route('contests.destroy', $contest) .'" onclick="destroyConfirmation(this)" title="'. __('Delete') .'"><i class="la la-trash"></i></button>';
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
     * @param \App\Models\Contest $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Contest $model)
    {
        $num_announcement = $this->request()->get('num_announcement');
        $description = $this->request()->get('description');
        $entity = $this->request()->get('entity');
        $type_act = $this->request()->get('type_act');
        $type_model = $this->request()->get('type_model');
        $type_contract = $this->request()->get('type_contract');
        $publication_date = $this->request()->get('publication_date');
        $publication_date_between = $this->request()->get('publication_date_between');
        $deadline_date = $this->request()->get('deadline_date');
        $deadline_date_between = $this->request()->get('deadline_date_between');
        $min_price = $this->request()->get('min_price');
        $query = $model->newQuery();


        if(!empty($num_announcement)){
            $query = $query->where('num_announcement','LIKE',"{$num_announcement}%");
        }
        if(!empty($entity)){
            $query = $query->where('entity','LIKE',"%{$entity}%");
        }
        if(!empty($description)){
            $query = $query->where('description','LIKE',"%{$description}%");
        }
        if(!empty($type_act)){
            $query = $query->where('type_act',$type_act);
        }
        if(!empty($type_model)){
            $query = $query->where('type_model',$type_model);
        }
        if(!empty($type_contract)){
            $query = $query->where('type_contract',$type_contract);
        }
        if(!empty($publication_date)){
            if(empty($publication_date_between)){
                $query = $query->where('publication_date','LIKE',$publication_date);
            }else {
                $query = $query->whereBetween('publication_date',[$publication_date,$publication_date_between]);
            }
        }
        if(!empty($deadline_date)){
            if(empty($deadline_date_between)) {
                $query = $query->where('deadline_date', 'LIKE', $deadline_date);
            }else{
                $query = $query->whereBetween('deadline_date',[$deadline_date,$deadline_date_between]);
            }
        }
        if(!empty($min_price)){
            $query = $query->where('price','>=',$min_price);
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
        /*->buttons(
            Button::make('reload')
            );*/
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
            //Column::make('base_id')->title($model->getAttributeLabel('base_id')),
            Column::make('num_announcement')->title($model->getAttributeLabel('num_announcement')),
            Column::make('description')->title($model->getAttributeLabel('description')),
            Column::make('entity')->title($model->getAttributeLabel('entity')),
            Column::make('price')->title($model->getAttributeLabel('price')),
            Column::make('publication_date')->title($model->getAttributeLabel('publication_date')),
            Column::make('deadline_date')->title($model->getAttributeLabel('deadline_date')),
            //Column::make('proposal_time_limit')->title($model->getAttributeLabel('proposal_time_limit')),
            //Column::make('republic_diary_num')->title($model->getAttributeLabel('republic_diary_num')),
            //Column::make('republic_diary_serie')->title($model->getAttributeLabel('republic_diary_serie')),
            //Column::make('cpv')->title($model->getAttributeLabel('cpv')),
            //Column::make('cpv_description')->title($model->getAttributeLabel('cpv_description')),
            //Column::make('procedure_parts')->title($model->getAttributeLabel('procedure_parts')),
            //Column::make('link_announcement')->title($model->getAttributeLabel('link_announcement')),
            //Column::make('pdf_content')->title($model->getAttributeLabel('pdf_content')),
            //Column::make('type_act')->title($model->getAttributeLabel('type_act')),
            //Column::make('type_model')->title($model->getAttributeLabel('type_model')),
            //Column::make('type_contract')->title($model->getAttributeLabel('type_contract')),
            //Column::make('status')->title($model->getAttributeLabel('status')),
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
