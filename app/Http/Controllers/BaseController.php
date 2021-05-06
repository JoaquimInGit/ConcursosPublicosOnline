<?php

namespace App\Http\Controllers;

use App\Models\Contest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\Panther\Client;

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
      /*  $response = Http::asForm()->post('https://www.base.gov.pt/Base4/pt/resultados/', [
            'type' => 'detail_anuncios',
            'id' => '263749'
        ]);
        $body = explode(",",$response->body());
        */
        $response = Http::asForm()->post('https://www.base.gov.pt/Base4/pt/resultados/', [
            'type'=>'search_anuncios',
            'query'=>'tipoacto=0&tipomodelo=0&tipocontrato=0',
            'sort'=>'-drPublicationDate',
            'size' => 100,
            //'page'=> 0
        ]);
        //$body = explode(",",$response->body());
        dd( $response->body());
/*
        Contest::create([
            'num_announcement' => $body["0"]["1"],
            'description' => $body["3"]["1"],
            'entity' => $table["2"]["1"],
            'type_act' => Contest::getTipe_act($body[][]),
            'type_model' => 1,
            'type_contract' => 1,
            'price' => floatval( $preco_conc),
            'publication_date' => date("Y-m-d"),
            'deadline' => $table[9][1],
            'state' => 1,
            'republic_diary' => $body["1"]["1"],
            'cpv' => $body["8"]["1"],
            'cpv_description' => $body["8"]["1"],
            'procedure_parts' => $body["11"]["1"],
            'pdf_content => "Adicionar Link'
        ]);
*/
    }
}
