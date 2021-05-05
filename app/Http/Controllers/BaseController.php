<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Panther\Client;

class BaseController extends Controller
{
   public function  index(){
       $concursos = [];
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
}
