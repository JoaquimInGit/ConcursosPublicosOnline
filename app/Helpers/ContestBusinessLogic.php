<?php


namespace App\Helpers;


use App\Models\Contest;
use Dompdf\Helpers;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades;
//use mysql_xdevapi\Exception;
use Smalot\PdfParser\Parser;
use Spatie\PdfToText\Pdf;
use Symfony\Component\Panther\Client;
use Exception;
use function Composer\Autoload\includeFile;
include 'pdfToText.php';

class ContestBusinessLogic
{
    public static function insertContests()
    {
        $ids = ContestBusinessLogic::discoverContests();

        //dd($ids);
        foreach ($ids as $id) {
            //Faz o pedido á pagina de detalhes com o id do anuncio pretendido
            $response = Http::asForm()->post('https://www.base.gov.pt/Base4/pt/resultados/', [
                'type' => 'detail_anuncios',
                'id' => '' . $id
            ]);
            //trasforma em objeto de php o corpo da resposta (json)
            $body = json_decode($response->body());
            //  dd($body);
              if($body->basePrice != null)
              {
                  //saca o preço e converte em float
                  $price = explode(' ', $body->basePrice);

                  //se o preço é maior que 999,99 irá conter um . a separar os valores. Ex: 123.123,04€
                  //portanto temos de os separar
                  if (str_contains($price[0], '.')) {
                      $price = explode('.', $price[0]);
                      $basePrice = '';
                      foreach ($price as $pc) {
                          $basePrice = $basePrice . $pc;
                      }
                  } else {
                      $basePrice = $price[0];
                  }
                  // $basePrice = $price[0] . $price[1];
                  //dd($basePrice);
                  $basePrice = str_replace(',', '.', $basePrice);
                  $basePrice = floatval($basePrice);
              }else{
                  $basePrice = null;
              }

              if($body->proposalDeadline != null) {
                  //dd( date("Y-m-d",strtotime($body->drPublicationDate)));
                  //Dias até a deadline inteiros
                  $daysDeadline = explode(' ', $body->proposalDeadline);
                  $daysDeadline = intval($daysDeadline[0]);

                  $date = date("Y-m-d", strtotime($body->drPublicationDate));
                  //data de publicação
                  $dateDeadline = date('Y-m-d', strtotime($date . ' + ' . $daysDeadline . ' days'));

                  $date = date("Y-m-d", strtotime($body->drPublicationDate));

              }else{
                  $dateDeadline = null;
                  $date = null;
                  if($body->drPublicationDate != null){
                      $date = date("Y-m-d", strtotime($body->drPublicationDate));
                  }
              }
            //dd();
            if ($body->cpvs != "Não definido.") {
                $cpv = explode(', ', $body->cpvs);
            } else {
                $cpv[0] = null;
                $cpv[1] = null;
            }

            Contest::create([
                'base_id' => $body->id == null ? null : $body->id,
                'num_announcement' => $body->announcementNumber == null ? null : $body->announcementNumber,
                'description' => $body->contractDesignation == null ? null : $body->contractDesignation,
                'entity' => $body->contractingEntities == [] ? null :  $body->contractingEntities[0]->description ,
                'price' => $basePrice,
                'publication_date' => $date,
                'deadline_date' => $dateDeadline,
                'proposal_time_limit' => $body->proposalDeadline == null ? null : $body->proposalDeadline,
                'republic_diary_num' => intval($body->dreNumber),
                'republic_diary_serie' => intval($body->dreSeries),
                'cpv' => $cpv[0],
                'cpv_description' => $cpv[1],
                //'procedure_parts' => ,
                'link_announcement' => $body->reference == null ? null: $body->reference,
                'pdf_content' => self::getdreText($body->announcementNumber, $body->type),
                'type_act' => Contest::typeActConverter($body->type),
                'type_model' => Contest::typeModelConverter($body->modelType),
                'type_contract' => Contest::typeContractConverter($body->contractType),
                'status' => 1,
            ]);
               // ->addMediaFromUrl($body->reference)//saca o pdf
              //  ->toMediaCollection('pdfs');//coloca-o na coleção
       }

    }

    /**
     * Requests Base and finds if exists new Contests, if it does it puts them in an Array
     * @return array retorna um Array de $ids do Anuncios do Base
     */
    public static function discoverContests()
    {
        if(Contest::count() != 0) {
            $lastid = Contest::getLastBaseId();
        }else{
            $lastid = 0;
        }
        // dd($lastid);
        $idArray = [];
        //TODO:penso que nao esteja a ir buscar 1000 anuncios
        $response = Http::asForm()->post('https://www.base.gov.pt/Base4/pt/resultados/', [
            'type' => 'search_anuncios',
            'query' => 'tipoacto=0&tipomodelo=0&tipocontrato=0',
            'sort' => '-drPublicationDate',
            'size' => 100,
            //'page'=> 0
        ]);
        //dd(json_decode($response->body()));
        $body = json_decode($response->body());
        foreach ($body->items as $item) {
            if ($item->id > $lastid) {
                array_push($idArray, $item->id);
            }

        }
        $idArray = array_reverse($idArray);
        return $idArray;
    }

    /***
     * @param $annuncementNumber  numero do anuncio com uma barra no meio
     * @param $type type of annuncement
     * @return json|null
     */
    public static function getdreText2($annuncementNumber, $type){
    //https://dre.pt/web/guest/pesquisa/-/search/164501469/details/normal?q=7292%2F2021
        //debaixo é o que funciona
        //https://dre.pt/web/guest/pesquisa/-/search/164505026/details/normal?q=7280%2F2021
        //$response = Http::get('https://dre.pt/web/guest/pesquisa/-/search/164501465/details/normal?q=7289%2F2021');
        //$dre = explode('<div class="vertical"><ul><li class="sumario">', $response->body());
        //dd($response->body());
        try {
            $q2 = str_replace(' ', '+', $type);
            $response2 = Http::get('https://dre.pt/web/guest/pesquisa/-/search/basic?q=' . $annuncementNumber . '+' . $q2);
            $dre = [];
            if (str_contains($response2->body(), '<div class="result">')) {
                $pos = stripos($response2->body(), '<div class="result">',);
                $stri = substr($response2->body(), $pos, 250);
                $pos = stripos($stri, '<a href',);
                $stri = substr($stri, $pos, 250);
                $pos = stripos($stri, '"');
                $pos++;
                $stri = substr($stri, $pos, 250);
                $stri = explode('"', $stri);

                $response = Http::get($stri[0]);
                //dd($response->body());
                $dre = explode('<div class="vertical"><ul><li class="sumario">', $response->body());
                //dd($dre);
                $position = strpos($dre[1], '<</li></ul></div>');
                $final = substr($dre[1], 0, -1 * $position);
                return json_encode($final);
            } else {
                return null;
            }
        }catch(Exception $e){
            //TODO:fazer log da exceção
            return null;
        }
    }


    public static function getdreText($annuncementNumber, $type){
        //https://dre.pt/web/guest/pesquisa/-/search/164501469/details/normal?q=7292%2F2021
        //debaixo é o que funciona
        //https://dre.pt/web/guest/pesquisa/-/search/164505026/details/normal?q=7280%2F2021
       // $response = Http::get('https://dre.pt/web/guest/pesquisa/-/search/164501465/details/normal?q=7289%2F2021');
        //$dre = explode('<div class="vertical"><ul><li class="sumario">', $response->body());
       // dd($response->body());

        try {
            $q2 = str_replace(' ', '+', $type);
            $response2 = Http::get('https://dre.pt/web/guest/pesquisa/-/search/basic?q=' . $annuncementNumber . '+' . $q2);
            $dre = [];
            if (str_contains($response2->body(), '<div class="result">')) {
              $pos = stripos($response2->body(), '<div class="result">',);
                $stri = substr($response2->body(), $pos, 250);
                $pos = stripos($stri, '<a href',);
                $stri = substr($stri, $pos, 250);
                $pos = stripos($stri, '"');
                $pos++;
                $stri = substr($stri, $pos, 250);
                $stri = explode('"', $stri);

                $response = Http::get($stri[0]);

                //dd($response->body());
                $dre = explode('<div class="vertical"><ul><li class="sumario">', $response->body());
                //dd($dre);
                $position = strpos($dre[1], '<</li></ul></div>');
                $final = substr($dre[1], 0, -1 * $position);
               // $final = '"'.$final.'"';
               // $final = htmlspecialchars(trim(strip_tags($final)));
               // $final = htmlspecialchars($final);

                $final = preg_replace("/<!--.*?-->/", "", $final);
                $final = str_replace("</p>", "###", $final);
                $final = strip_tags($final);

                $final = str_replace("\n", "", $final);
               // $final = preg_replace("/\r|\n/", '\n', $final);

              //  $final = str_replace("\'", '', $final);
              //  $final = str_replace('\"', '', $final);

                $final = ltrim($final, '\"');
                $final = str_replace(['\"',"\'"], "", $final);
                $final = html_entity_decode($final);
              //  $final = str_replace("###", "\n", $final);
                $final = str_replace("###", "&#10;&#13;", $final);
               // $final = print_r($final);
                //ddd($final);


                return json_encode($final);
            } else {
                return null;
            }
        }catch (Exception $e){
            return null;
        }
    }

}
