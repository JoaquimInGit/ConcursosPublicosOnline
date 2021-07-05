<?php

namespace App\Http\Controllers;

use App\DataTables\ContestDataTable;
use App\Helpers\FiltersLogic;
use App\Models\Base;
use App\Models\Contest;
use App\Models\ContestFilter;
use App\Models\Entity;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Spatie\PdfToText\Pdf;
use Symfony\Component\Panther\Client;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\MediaStream;
use App\Helpers\ContestBusinessLogic;
class BaseController extends Controller
{
   public function  index(){

       $id = 263674;
       for($i = 0; $i<1; $i++){

           $url = 'https://www.base.gov.pt/Base4/pt/detalhe/?type=anuncios&id='.$id;
           //criar a conexao com o cliente selenium
           $client = Client::createSeleniumClient('http://selenium:4444/wd/hub', null,$url );
           //Fazer request á pagina
           $client->request('GET', $url);
           $crawler = $client->waitFor('#no-more-tables-mx767');
           //echo $crawler->filter('#no-more-tables-mx767')->text();
           // $crawler->filterXPath('//*[@id="no-more-tables-mx767"]/table/tbody/tr[1]/td[2]')->text();
           $table = $crawler->filter('table')->filter('tr')->each(function ($tr, $i) {
               return $tr->filter('td')->each(function ($td, $i) {
                   return trim($td->text());
               });
           });
           array_push($concursos, $table);
           // dd($table);
           $id = $id -1;
       }
       ddd($concursos);
    }
    public function insertContest(){

        $id = 263674;
        for ($i = 0; $i<5; $i++) {
            $url = 'https://www.base.gov.pt/Base4/pt/detalhe/?type=anuncios&id=' . $id;
            //criar a conexao com o cliente selenium
            $client = Client::createSeleniumClient('http://selenium:4444/wd/hub', null, $url);
            //Fazer request á pagina
            $client->request('GET', $url);
            $crawler = $client->waitFor('#no-more-tables-mx767');
            //echo $crawler->filter('#no-more-tables-mx767')->text();
            // $crawler->filterXPath('//*[@id="no-more-tables-mx767"]/table/tbody/tr[1]/td[2]')->text();
            $table = $crawler->filter('table')->filter('tr')->each(function ($tr, $i) {
                return $tr->filter('td')->each(function ($td, $i) {
                    return trim($td->text());
                });
            });

            $preco = explode(' ', $table["7"]["1"]);
            $preco = explode(",", $preco[0]);
            $preco_conc = $preco[0].'.'.$preco[1];
            echo (floatval( $preco_conc));
            //dd($table);
            Contest::create([
                'num_announcement' => $table["0"]["1"],
                'description' => $table["3"]["1"],
                'entity' => $table["2"]["1"],
                'type_act' => wqqwe,
                'type_model' => 1,
                'type_contract' => 1,
                'price' => floatval( $preco_conc),
                'publication_date' => date("Y-m-d"),
                'deadline' => $table[9][1],
                'state' => 1,
                'republic_diary' => $table["1"]["1"],
                'cpv' => $table["8"]["1"],
                'cpv_description' => $table["8"]["1"],
                'procedure_parts' => $table["11"]["1"],
                'pdf_content => "Adicionar Link'
            ]);
        $id--;
        }
    }
    public function insertContest2(){
        ContestBusinessLogic::insertContests();
       // ContestBusinessLogic::getdreText();
        echo "done";
    }

    public function filterNotification(){
       FiltersLogic::sendNotifications();
        echo "done";
    }

    public function applyfilter(){

       // FiltersLogic::applyFilter();
    }

    public function applyFilterToAllContests(){

        //$entity = ContestFilter::getEntity();
        //$filters = ContestFilter::getFiltersEntity($entity);
      //// dd($filters);
       //FiltersLogic::applyFilterToAllContests();

        $query = ContestFilter::query();

        if(auth()->user()->can('accessAsUser')){
            $entity = ContestFilter::getEntity();
            $filters = ContestFilter::getFiltersEntity($entity);
            //$query = $query->where('filter_id', $filter);
            $query = $query->where(function($q) use ($filters){
                foreach ($filters as $filter) {

                    $q->orWhere('filter_id', $filter->id);
                  //  dd($q->get()->toArray());
                }
            });
            ///Debugbar($query);
        }
        ddd($query);
        return $query;


    }
}
