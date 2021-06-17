<?php


namespace App\Helpers;


use App\Models\Contest;
use App\Models\ContestFilter;
use App\Models\Entity;
use App\Models\Filter;
use App\Models\User;
use App\Notifications\FilterNotification;
use Carbon\Carbon;

class FiltersLogic
{
    public static function applyFilter()
    {
        $filters = Filter::where('filter_status', '>=', 1)->get()->toArray();
        $filters = json_encode($filters);
        $filters = json_decode($filters);
        //   dd($filters);
        //ddd($teste);
        foreach ($filters as $filter) {
            // dd($filter->filter_name);
            $contests = Contest::where('created_at', '>=', today()->toDate());

            if (!empty($filter->description_words)) {
                //dd($filter->description_words);
                $keywords = explode(',', $filter->description_words);
                $keys = "";
                foreach ($keywords as $word) {
                    $aux = explode('"value":"', $word);
                    $keys = $keys . $aux[1];
                }
                $keys = str_replace('"}', ' ', $keys);
                $keys = str_replace(']', ' ', $keys);
                //dd($keys);
                $searchValues = preg_split('/\s+/', $keys, -1, PREG_SPLIT_NO_EMPTY);
                //dd($searchValues);
                $contests = $contests->where(function ($q) use ($searchValues) {
                    foreach ($searchValues as $value) {
                        $q->orWhere('description', 'like', "%{$value}%")
                            ->orWhere('pdf_content', 'like', "%{$value}%");
                        // ->orWhere('cpv_description', 'like', "%{$value}%");
                    }
                })->get();
//dd($contests);
            }

            if (!empty($filter->contest_entity)) {
                $contests = $contests->where('entity', 'LIKE', "%" . $filter->contest_entity . "%")->get();
            }

            if (!empty($filter->district)) {
                $contests = $contests->where('pdf_content', 'LIKE', "%" . $filter->district . "%")->get();
            }
            //dd($contests);
            if (!empty($filter->min_price)) {
                $contests = $contests->where('price', '>=', $filter->min_price)->get();
            }
            if (!empty($filter->max_price)) {
                $contests = $contests->where('price', '<=', $filter->max_price)->get();
            }
            if (!empty($filter->cpv)) {
                $contests = $contests->where('cpv', $filter->cpv)->get();
            }
            if (!empty($filter->type_act)) {
                $contests = $contests->where('type_act', $filter->type_act)->get();
            }
            if (!empty($filter->type_model)) {
                $contests = $contests->where('type_model', $filter->type_model)->get();
            }
            if (!empty($filter->type_contract)) {
                $contests = $contests->where('type_contract', $filter->type_contract)->get();
            }
            if ($contests != null) {
                $contests = $contests->toArray();
                $contests = json_encode($contests);
                $contests = json_decode($contests);
                //dd($contests);
                foreach ($contests as $contest) {
                    //dd($contest);
                    ContestFilter::create([
                        'contest_id' => $contest->id,
                        'filter_id' => $filter->id,
                        'date' => Carbon::now()
                    ]);
                }
            }

        }
    }
    /**
     * Envia notificações consoante os ultimos registos criados na tabela de relação entre os contests e os filters
     */
    public static function sendNotifications(){
        //guarda todas a entidades ativas
        $entities = Entity::where('status',1)->get();

        //array para enviar os contests de cada entidade
        $contestsArray = array();
        //$filtersArray = array();

        //por cada entidade
        foreach ($entities as $entity){
            //encontra filtros de uma dada entidade
            $filtros = Filter::where('entity_id',$entity->id)->get();
            //encontra o user de uma dada entidade
            $user = User::where('id',$entity->user_id)->first();

            //por cada filtro
            foreach ($filtros as $filtro){
                //encontra registos da relação Contest Filter
                $contests = ContestFilter::where([['filter_id',$filtro->id],['date',today()->toDate()]])->get();

                //se o resultado da query anterior não for null
                if (!empty($contests)){
                    //$fil = Filter::where('id',$filtro->id)->first();
                    //array_push($filtersArray, $fil);
                    //por cada concurso
                    foreach($contests as $c){
                        //colocamos o concurso no array
                        $cont = Contest::where('id',$c->contest_id)->first();
                        array_push($contestsArray, $cont);
                    }
                }
            }
            //se o array não for null
            if(!empty($contestsArray)){
                //enviamos uma notifiação
                $user->notify(new FilterNotification($contestsArray));
                //colocamos o array vazio
                $contestsArray = array();
                $filtersArray = array();
            }
        }

    }
}