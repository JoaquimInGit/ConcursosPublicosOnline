<?php

namespace App\DataTables;

use App\Models\Contest;
use App\Models\ContestEntity;
use App\Models\Entity;
use App\Models\User;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
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
            ->editColumn('price', function($contest){
                return !empty($contest->price) ? number_format($contest->price, 2, ',', '.').'€' : '';
            })
            ->editColumn('publication_date', function ($contest){
                return !empty($contest->publication_date) ? Carbon::Parse($contest->publication_date)->format('d-m-Y') : '';
            })
            ->editColumn('deadline_date', function ($contest){
                return !empty($contest->deadline_date) ? Carbon::Parse($contest->deadline_date)->format('d-m-Y') : '';
            })
            ->addColumn('action', function ($contest) {
               // \Debugbar::error($contest);
                if(auth()->user()->can('accessAsUser')){
                    $entity = Entity::getCurrentEntity();
                    //\Debugbar::error($entity);
                    $contestentity = ContestEntity::getRegisto($contest,$entity)->first();
                   // \Debugbar::error($contestentity->$contestentity->follow == 1);
                    //\Debugbar::error(!empty($contestentity));
                    if(!empty($contestentity) && $contestentity->follow == 1){
                        return '<a class="btn btn-sm btn-clean btn-icon btn-icon-md" href="'. route('contests.show', $contest) .'" title="'. __('View') .'"><i class="la la-eye"></i></a>'.
                        '<a class="btn btn-sm btn-clean btn-icon btn-icon-md follow" onclick="follow('.$contest->id.')" title="'. __('Follow').'"> <i class="la la-star" style="color:blue"></i></a>';
                    }else{
                        return '<a class="btn btn-sm btn-clean btn-icon btn-icon-md" href="'. route('contests.show', $contest) .'" title="'. __('View') .'"><i class="la la-eye"></i></a>'.
                            '<a class="btn btn-sm btn-clean btn-icon btn-icon-md follow" onclick="follow('.$contest->id.')" title="'. __('Follow').'"> <i class="la la-star"></i></a>';
                    }

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
        $cpv = $this->request()->get('cpv');
        $cpv_description = $this->request()->get('cpv_description');
        $type_act = $this->request()->get('type_act');
        $type_model = $this->request()->get('type_model');
        $type_contract = $this->request()->get('type_contract');
        $publication_date = $this->request()->get('publication_date');
        $publication_date_between = $this->request()->get('publication_date_between');
        $deadline_date = $this->request()->get('deadline_date');
        $deadline_date_between = $this->request()->get('deadline_date_between');
        $min_price = $this->request()->get('min_price');
        $viewed_at = $this->request()->get('viewed_at');
        $follow = $this->request()->get('follow');
        $notified = $this->request()->get('notified');
        $query = $model->newQuery();


        if (!empty($num_announcement)) {
            $query = $query->where('num_announcement', 'LIKE', "{$num_announcement}%");
        }
        if (!empty($entity)) {
            $query = $query->where('entity', 'LIKE', "%{$entity}%");
        }
        if (!empty($description)) {
            $query = $query->where('description', 'LIKE', "%{$description}%");
        }
        if (!empty($cpv)) {
            $query = $query->where('cpv', 'LIKE', "%{$cpv}%");
        }
        if (!empty($cpv_description)) {
            $query = $query->where('cpv_description', 'LIKE', "%{$cpv_description}%");
        }
        if (!empty($type_act)) {
            $query = $query->where('type_act', $type_act);
        }
        if (!empty($type_model)) {
            $query = $query->where('type_model', $type_model);
        }
        if (!empty($type_contract)) {
            $query = $query->where('type_contract', $type_contract);
        }
        if (!empty($publication_date)) {
            if (empty($publication_date_between)) {
                $query = $query->where('publication_date', 'LIKE', Carbon::Parse($publication_date)->format('Y-m-d'));
            } else {
                $query = $query->whereBetween('publication_date', [Carbon::Parse($publication_date)->format('Y-m-d'), Carbon::Parse($publication_date_between)->format('Y-m-d')]);
            }
        }
        if (!empty($deadline_date)) {
            if (empty($deadline_date_between)) {
                $query = $query->where('deadline_date', 'LIKE', Carbon::Parse($deadline_date)->format('Y-m-d'));
            } else {
                $query = $query->whereBetween('deadline_date', [Carbon::Parse($deadline_date)->format('Y-m-d'), Carbon::Parse($deadline_date_between)->format('Y-m-d')]);
            }
        }
        if (!empty($min_price)) {
            $query = $query->where('price', '>=', $min_price);
        }
        if ($viewed_at == true) {
            $query = $query->whereIn('id', function ($query) {
                $query->select('contest_id')
                    ->from('contest_entity')
                    ->where([['entity_id', Entity::getCurrentEntity()->id], ['viewed_at', '!=', null]]);
            });
        }
        if ($follow == true) {
            $query = $query->whereIn('id', function ($query) {
                $query->select('contest_id')
                    ->from('contest_entity')
                    ->where([['entity_id', Entity::getCurrentEntity()->id], ['follow', 1]]);
            });
        }
        if ($notified == true) {
            $query = $query->whereIn('id', function ($query) {
                $query->select('contest_id')
                    ->from('contest_filters')
                    ->whereIn('filter_id', function ($query) {
                        $query->select('id')
                            ->from('filters')
                            ->where('entity_id', Entity::getCurrentEntity()->id);
                    });
            });
        }
        if(User::subscribed()){
            return $query;
        }else{
            return Contest::query()->whereNull('id');
        }
        //return User::subscribed() ? $query : null;
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
            ->pageLength(50)
            ->minifiedAjax()
            ->dom("<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>><'table-responsive'rt>ip") // Bfrtip
             //   ->searchCols([ 'type' => "(1|2)"])
            ->initComplete($this->searchJS)
            ->orderBy([4, 'desc'])
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
