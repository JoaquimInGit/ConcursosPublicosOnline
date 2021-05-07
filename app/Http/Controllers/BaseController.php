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
       $ids = $this->discoverids();
       foreach($ids as $id) {
           //Faz o pedido á pagina de detalhes com o id do anuncio pretendido
           $response = Http::asForm()->post('https://www.base.gov.pt/Base4/pt/resultados/', [
               'type' => 'detail_anuncios',
               'id' => '' . $id
           ]);
           //trasforma em objeto de php o corpo da resposta (json)
           $body = json_decode($response->body());

           //saca o preço e converte em float
           $price = explode(' ', $body->basePrice);
           $price = explode('.', $price[0]);
           $basePrice = $price[0] . $price[1];
           $basePrice = str_replace(',', '.', $basePrice);
           $basePrice = floatval($basePrice);
           //dd( date("Y-m-d",strtotime($body->drPublicationDate)));
           //Dias até a deadline inteiros
           $daysDeadline = explode(' ', $body->proposalDeadline);
           $daysDeadline = intval($daysDeadline[0]);

           //data de publicação
           $date = date("Y-m-d", strtotime($body->drPublicationDate));
           $dateDeadline = date('Y-m-d', strtotime($date . ' + ' . $daysDeadline . ' days'));
           //dd();
           $cpv = explode(', ', $body->cpvs);

           Contest::create([
               'base_id' => $body->id,
               'num_announcement' => $body->announcementNumber,
               'description' => $body->contractDesignation,
               'entity' => $body->contractingEntities[0]->description,/*
            'type_act' => 'nullable|boolean',
            'type_model' => 'nullable|boolean',
            'type_contract' => 'nullable|boolean',*/
               'price' => $basePrice,
               'publication_date' => $date,
               'deadline_date' => $dateDeadline,
               'status' => 1,
               'republic_diary_num' => intval($body->dreNumber),
               'republic_diary_serie' => intval($body->dreSeries),
               'cpv' => $cpv[0],
               'cpv_description' => $cpv[1],
               //'procedure_parts' => ,
               'link_announcement' => $body->reference,
               // 'pdf_content' => 'nullable|string'
           ]);
           echo "Inserção concluida";
       }
    }

    public function discoverids(){
       //TODO: descobrir o ultimo id da tabela Contests e depois ir contando até la chegar
       $idArray = [];
        $response = Http::asForm()->post('https://www.base.gov.pt/Base4/pt/resultados/', [
            'type'=>'search_anuncios',
            'query'=>'tipoacto=0&tipomodelo=0&tipocontrato=0',
            'sort'=>'-drPublicationDate',
            'size' => 25,
            //'page'=> 0
        ]);
        $body = json_decode($response->body());
        foreach($body->items as $item){
            array_push($idArray,$item->id);
        }
     return $idArray;
    }
}
