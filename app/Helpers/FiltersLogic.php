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
    /***
     *função que permite aplicar um filtro
     * insere os resultados na tabela contestFilters
     * nao coloca registos repetidos
     */
    public static function applyFilter()
    {
        $date = date('H') + 1;
       //dd($date);
        if($date > 14){
            $time = Carbon::create(date('Y'), date('m'), date('d'), 14, 0, 0, 'GMT');
            $filters = Filter::where('filter_status', '>=', 1)->where("created_at", '>', $time)->get()->toArray();
        }
        else{
            $filters = Filter::where('filter_status', '>=', 1)->get()->toArray();
        }

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
                });
//dd($contests);
            }

            if (!empty($filter->contest_entity)) {
                $contests = $contests->where('entity', 'LIKE', "%" . $filter->contest_entity . "%");
            }

            if (!empty($filter->district)) {
                $contests = $contests->where('pdf_content', 'LIKE', "%" . $filter->district . "%");
            }
            //dd($contests);
            if (!empty($filter->min_price)) {
                $contests = $contests->where('price', '>=', $filter->min_price);
            }
            if (!empty($filter->max_price)) {
                $contests = $contests->where('price', '<=', $filter->max_price);
            }
            if (!empty($filter->cpv)) {
                $contests = $contests->where('cpv', $filter->cpv);
            }
            if (!empty($filter->type_act)) {
              // ddd($filter->type_act);
                $contests = $contests->where('type_act', $filter->type_act);
                //ddd($contests->toArray());
            }
            if (!empty($filter->type_model)) {
             //   ddd($filter->type_model);
              //  ddd($contests->toArray());
              //  ddd($filter->type_model);
               // ddd($contests->where('type_model',$filter->type_model));
              //  ddd($contests->toArray());
              //  if($contests->where('type_model', $filter->type_model)->get() != null){
                    $contests = $contests->where('type_model', $filter->type_model);
                //}

            }
            if (!empty($filter->type_contract)) {
                $contests = $contests->where('type_contract', $filter->type_contract);
            }
            if ($contests != null) {
                $contests = $contests->get()->toArray();

                $contests = json_encode($contests);
                $contests = json_decode($contests);

                //Retira todos os contestFilters da DB
                $contestFilters = ContestFilter::where('filter_id', '=', $filter->id)->get();
                foreach ($contests as $contest) {
                    //vai validar um registo do contest filters para evitar que se coloquem repetidos
                    if($contestFilters->where('contest_id', '=', $contest->id)->count() == 0) {
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
    }

    /***
     *função que permite aplicar filtros a todos os registos da tabela contests
     * insere os resultados na tabela contestFilters
     * nao coloca registos repetidos
     */
    public static function applyFilterToAllContests()
    {
        $i =0;
        $filters = Filter::where('filter_status', '>=', 1)->get()->toArray();
        $filters = json_encode($filters);
        $filters = json_decode($filters);
        //   dd($filters);
        //ddd($teste);
        foreach ($filters as $filter) {

            $contests = Contest::query();

            if (!empty($filter->description_words)) {
                $i = $i + 1;
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

                    }
                })->get();
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

                //Retira todos os contestFilters da DB
                $contestFilters = ContestFilter::where('filter_id', '=', $filter->id)->get();
                foreach ($contests as $contest) {
                    //vai validar um registo do contest filters para evitar que se coloquem repetidos
                    if($contestFilters->where('contest_id', '=', $contest->id)->count() == 0) {
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
    }

    /**
     * Envia notificações consoante os ultimos registos criados na tabela de relação entre os contests e os filters
     */
    public static function sendNotifications(){
        //guarda todas a entidades ativas
        $currentTime = date("Y-m-d H:i:s");

        $firstScrapeTime = date("Y-m-d 9:i:s");
        //ddd($currentTime.' '.$firstScrapeTime);
        $entities = Entity::where('status','>=',1)->get();

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
            foreach ($filtros as $filtro) {
                //encontra registos da relação Contest Filter
                //$contests = ContestFilter::where([['filter_id', $filtro->id], ['date', today()->toDate()]])->get();
                //ddd($currentTime < $firstScrapeTime);
               // ddd($currentTime > $firstScrapeTime);

                if($currentTime < $firstScrapeTime){
                //   ddd($firstScrapeTime);
                $contests = ContestFilter::where([['filter_id',$filtro->id],['created_at','>',$firstScrapeTime]])->get();
                //$contests = ContestFilter::where('created_at','>',$firstScrapeTime)->get();
                //ddd($contests);
                }else{
                $contests = ContestFilter::where([['filter_id', $filtro->id], ['date', today()->toDate()]])->get();
                }
               // ddd();
                //se o resultado da query anterior não for null
               // if (!empty($contests)){
                if (sizeof($contests) != 0){
                   // ddd($contests);
                    //$fil = Filter::where('id',$filtro->id)->first();
                    //array_push($filtersArray, $fil);
                    //por cada concurso
                    foreach($contests as $c){
                        //colocamos o concurso no array
                        $cont = Contest::where('id',$c->contest_id)
                            ->first();
                      //ddd($cont);
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