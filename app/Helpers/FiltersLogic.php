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
    public static function applyFilter($filter)
    {

    }

    /**
     * Envia notificações consoante os ultimos registos criados na tabela de relação entre os contests e os filters
     */
    public static function sendNotifications(){
        //guarda todas a entidades ativas
        $entities = Entity::where('status',1)->get();

        //array para enviar os contests de cada entidade
        $contestsArray = array();

        //por cada entidade
        foreach ($entities as $entity){
            //encontra filtros de uma dada entidade
            $filtros = Filter::where('entity_id',$entity->id)->get();
            //encontra o user de uma dada entidade
            $user = User::where('id',$entity->user_id)->first();

            //por cada filtro
            foreach ($filtros as $filtro){
                //encontra registos da relação Contest Filter
                $contests = ContestFilter::where([['filter_id',$filtro->id],['date','2021-05-30']])->get();

                //se o resultado da query anterior não for null
                if (!empty($contests)){

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
            }
        }

    }
}