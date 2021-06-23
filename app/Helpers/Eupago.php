<?php

namespace App\Helpers;
use Illuminate\Support\Facades\DB;

use SoapClient;
use SoapHeader;

class Eupago
{
    private $_instance;
    private $_wsdlDev = 'https://sandbox.eupago.pt/replica.eupagov20.wsdl';
    private $_wsdlProd = 'https://seguro.eupago.pt/eupagov20.wsdl';
    private $_wsdl = null;
    private $_client = null;
    private $_apiKey = null;
    private $_currency = null;
    //private $_transactionId = null;
    private $_inSandbox = false;
    private $_callbackUrl = "";

    public function __construct()
    {
        if(empty($this->_apiKey)){
            $this->setApiKey(config('eupago.key'));
            if(config('eupago.sandbox') == true)
                $this->inDevelopment();
            $this->_callbackUrl = config('eupago.callback_url');
        }
        /*if(!$this->_instance){
            $this->_instance = new Eupago();
            $this->_instance->setApiKey(config(eupago.key));
            if(config(eupago.key) == true)
                $this->_instance->inDevelopment();
        }*/
        //return self::$_instance;
    }
    public function setApiKey($apikey)
    {
        $this->_apiKey = $apikey;
    }
    public function inDevelopment()
    {
        $this->_inSandbox = true;
    }

    /*public function setTransactionId($transactionId)
    {
        $this->_transactionId = $transactionId;
    }*/
    private function getClient()
    {
        $this->_wsdl = $this->_inSandbox ? $this->_wsdlDev : $this->_wsdlProd;

        return $this->_client = new SoapClient($this->_wsdl);
        /*return $this->_client = new SoapClient($this->_wsdl, [
            'soap_version'   => SOAP_1_2,
            'style'    => SOAP_DOCUMENT,
            'use' => SOAP_LITERAL,
            'cache_wsdl' => WSDL_CACHE_NONE,
        ]);*/
    }
    public function generateReferenceMB($reference, $value, $dateLimit = null)
    {
        $params = [
            'valor'     => $value,
            'chave'     => $this->_apiKey,
            'id'        => $reference,
            'data_fim'  => $dateLimit,
            'per_dup' => 0, //pagamentos duplicados 0 - não permite | 1 - permite
            //'admin_callback' => $this->_callbackUrl,
            'testa_pagamento' => $this->_inSandbox ? 1 : 0

        ];
        $response = $this->getClient()->gerarReferenciaMB($params);
        return $response;
    }

    public function generateMBWay($reference, $value, $phone,$descricao)
    {
        $params = [
            'valor'     => $value,
            'chave'     => $this->_apiKey,
            'id'        => $reference,
            'alias'     => $phone,
            'descricao' => $descricao,
        ];
        $response = $this->getClient()->pedidoMBW($params);
        return $response;
    }
    public function generateCC($value, $name, $email, $lang = 'pt')
    {
        $params = [
            'valor' => $value,
            'chave' => $this->_apiKey,
            'id'    => $this->_transactionId,
            'nome'    => $name,
            'email'    => $email,
            'lang'    => $lang,
        ];
        $response = $this->getClient()->PedidoCC($params);
        return $response;
    }
    public function referenceInformation($reference)
    {
        $params = [
            'chave'      => $this->_apiKey,
            'referencia' => $reference
        ];
        $response = $this->getClient()->informacaoReferencia($params);
        return $response;
    }

    /**
     * Create a "Debito Direto" on eupago
     * Tipo de Pagamento - (Pontual; OOFF | Recorrente: RCUR)
     * Auto Processar -  0 - Não permite o auto-processamento, 1 - Permite o auto-processamento
     * Data - Data de Levantamento do Pagamento
     * Periocidade - periocidade do Pagamento
     * Data_final - Data limite até à qual pode ser efectuado o Levantamento do Pagamento.
     *
     * @param $reference
     * @param array $client[] "nome","email","morada","cod_postal,"cidade","pais","iban","swift"
     * @param array $payment[] "valor","tipo","data","periodicidade","data_final","auto_processar"
     * @return mixed
     */
    public function generateDD($reference,array $client, array $payment)
    {
        //$payment['admin_callback']=$this->_callbackUrl;
        $params = [
            'chave'     => $this->_apiKey,
            'id'        => $reference,
            'devedor'   => $client,
            'pagamento'  => $payment,
            'admin_callback' => $this->_callbackUrl
        ];
        $response = $this->getClient()->autorizacaoDD($params);
        return $response;
    }

    public function checkValidResponse($result){
        if (is_soap_fault($result)) {
            //dd("SOAP Fault: (faultcode: {$result->faultcode}, faultstring: {$result->faultstring})", E_ERROR);
            \Debugbar::error("SOAP Fault: (faultcode: {$result->faultcode}, faultstring: {$result->faultstring})");
            return false;
        } else {
            //estados possíveis: 0 sucesso. -10 Chave inválida. -9 Valores incorretos
            if ($result->estado == 0) {
                return true;
            } else {
                \Debugbar::error("Error code: ".$result->estado);
                return false;
            }
        }
    }
}