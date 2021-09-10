<?php

namespace App\Helpers;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Facades\Setting;
use DvK\Laravel\Vat\Facades\Validator;

class Moloni
{

    //private $_instance;
    private $_productionEndpointUrl = 'https://api.moloni.pt/v1/';
    private $_sandboxEndpointUrl = 'https://api.moloni.pt/sandbox/';
    private $_endpointUrl = "https://api.moloni.pt/sandbox/";

    public $accessToken;
    public $refreshToken;

    private $_wsdlProd = 'https://seguro.eupago.pt/eupagov20.wsdl';
    private $_wsdl = null;
    private $_client = null;
    private $_apiKey = null;
    private $_currency = null;
    //private $_transactionId = null;
    private $_inSandbox = false;


    public function __construct()
    {
        $this->_endpointUrl = config('moloni.sandbox') == true ?  $this->_sandboxEndpointUrl : $this->_productionEndpointUrl;

        /*if(empty($this->_apiKey)){
            $this->setApiKey(config('eupago.key'));



        }*/
        /*if(!$this->_instance){
            $this->_instance = new Eupago();
            $this->_instance->setApiKey(config(eupago.key));
            if(config(eupago.key) == true)
                $this->_instance->inDevelopment();
        }*/
        //return self::$_instance;
    }

    /**
     * Do the login for moloni, this is a second method for login and don't require callback, it used the user password
     * @return boolean
     */
    public function login(){
        $response = Http::get($this->_endpointUrl."grant/?grant_type=password&client_id=".Setting::getParam('moloni_client_id')."&username=".Setting::getParam('moloni_email')."&client_secret=".Setting::getParam('moloni_client_secret')."&password=".urlencode(Setting::getParam('moloni_password')));
        if($response->successful()){
            \Debugbar::info($response);
            $data = $response->json();
            \Debugbar::info($data);
            if(!empty($data['error'])){
                return false;
            }else{
                $this->accessToken = $data['access_token'];
                Cache::put('moloni_access_token', $this->accessToken);
                $this->refreshToken = $data['refresh_token'];
                Cache::put('moloni_refresh_token', $this->refreshToken);
                Cache::put('moloni_expire_access_token', (time()+intval($data['expires_in'])));
                Cache::put('moloni_expire_refresh_token', (time()+1209600));// 14 days
                \Debugbar::info('grava cache');
                return true;
            }
        }else{

            return false;
        }
    }

    /**
     * Check is the current token is valid of if is possible to get a valid token
     * @return boolean
     */
    public function isTokenValid(){
        if(Cache::get('moloni_expire_access_token') > time() || Cache::get('moloni_expire_refresh_token') > time()){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Try to get the token if have expired try to refresh it and get a new one.
     */
    public function getToken(){
        if(Cache::get('moloni_expire_access_token') > time()){
            $this->accessToken = Cache::get('moloni_access_token');
            return $this->accessToken;
        }elseif(Cache::get('moloni_expire_refresh_token') > time()){
            if($this->refreshToken())
                return $this->accessToken;
            else{
                $this->accessToken = null;
                $this->refreshToken = null;
                return false;
            }
        }
    }

    /**
     * Check is the current token is valid
     * @return boolean
     */
    public function refreshToken($token = null, $refresh_token = null){
        if($token == null)
            $token = Cache::get('moloni_access_token');
        if($refresh_token == null)
            $refresh_token = Cache::get('moloni_refresh_token');
        $response = Http::post($this->_endpointUrl."grant/?grant_type=refresh_token&client_id=".Setting::getParam('moloni_client_id')."&client_secret=".Setting::getParam('moloni_client_secret')."&refresh_token=$refresh_token");

        if ($response->successful()) {
            \Debugbar::info($response);
            $data = $response->json();
            \Debugbar::info($data);
            if(!empty($data['error'])){
                return false;
            }else{
                $this->accessToken = $data['access_token'];
                Cache::put('moloni_access_token', $this->accessToken);
                $this->refreshToken = $data['refresh_token'];
                Cache::put('moloni_refresh_token', $this->refreshToken);
                Cache::put('moloni_expire_access_token', (time()+intval($data['expires_in'])));
                Cache::put('moloni_expire_refresh_token', (time()+1209600));// 14 days
                \Debugbar::info('grava cache');
                return true;
            }
        }else{
            \Debugbar::info($response);
            return false;
        }

    }

    /**
     * Return all companies of the current account
     * @return boolean or array
     */
    public function getAllCompanies(){
        if($this->getToken() == false){
            return false;
        }else{
            $response = Http::get($this->_endpointUrl."companies/getAll/?access_token=$this->accessToken");
            if ($response->successful()) {
                \Debugbar::info($response);
                $data = $response->json();
                \Debugbar::info($data);
                if(!empty($data['error'])){
                    if($data['error'] == 'invalid_request' && $data['error_description'] == 'Invalid access token.'){
                        Cache::forget('moloni_access_token');
                        Cache::forget('moloni_expire_access_token');
                        $this->accessToken = null;
                    }
                    return false;
                }else{
                    return $data;
                }
            }else{
                \Debugbar::info($response);
                return false;
            }
        }
    }

    /**
     * Return all customers of the current account, return 50 at a time to get the second 50 shoud ask $offset+50
     * @param integer $offset
     * @return boolean or array
     */
    public function getAllCustomers($offset = 0){
        if($this->getToken() == false){
            return false;
        }else{
            $response = Http::post($this->_endpointUrl."customers/getAll/?access_token=$this->accessToken&json=true", ['company_id' => Setting::getParam('moloni_company_id'), 'offset'=>$offset]);
            if ($response->successful()) {
                \Debugbar::info($response);
                $data = $response->json();
                \Debugbar::info($data);
                if(!empty($data['error'])){
                    if($data['error'] == 'invalid_request' && $data['error_description'] == 'Invalid access token.'){
                        Cache::forget('moloni_access_token');
                        Cache::forget('moloni_expire_access_token');
                        $this->accessToken = null;
                    }
                    return false;
                }else{
                    return $data;
                }
            }else{
                \Debugbar::info($response);
                return false;
            }
        }
    }

    /**
     * Return all customers by number
     * @param integer $offset
     * @return boolean or array
     */
    public function getCustomerByNumber($number, $offset = 0){
        if($this->getToken() == false){
            return false;
        }else{
            $response = Http::post($this->_endpointUrl."customers/getByNumber/?access_token=$this->accessToken&json=true", [
                'company_id' => Setting::getParam('moloni_company_id'),
                'number' => $number,
                'offset'=>$offset
            ]);
            return $this->checkValidResponse($response);
        }
    }



    /**
     * Return all customers by vat
     * @param integer $offset
     * @return boolean or array
     */
    public function getCustomerByVat($vat, $offset = 0){
        if($this->getToken() == false){
            return false;
        }else{
            $response = Http::post($this->_endpointUrl."customers/getByVat/?access_token=$this->accessToken&json=true", [
                'company_id' => Setting::getParam('moloni_company_id'),
                'vat' => $vat,
                'offset'=>$offset
            ]);
            return $this->checkValidResponse($response);
        }
    }

    /**
     * Create a new customer
     * @return boolean or array
     */
    public function insertCustomer($name, $number, $address, $city, $vat='999999990', $zip=null, $email = null){
        if($this->getToken() == false){
            return false;
        }else{
            \Debugbar::info("Vai criar cliente com os seguintes dados");
            $data = [
                'company_id' => Setting::getParam('moloni_company_id'),
                "vat"=>$vat,
                "number"=>$number,
                "name"=>$name,
                "language_id"=>1,
                "address"=>empty($address) ? "Desconhecido" : $address,
                "zip_code"=>empty($zip) ? "0000-000" : $zip,
                "city"=>empty($city) ? "Desconhecido" : $city,
                "country_id"=>1,
                "email"=>$email,
                //"payment_method_id"=> Setting::getParam('moloni_mb_payment_id'), //antes estava 0
                "payment_method_id"=> 1,
                "maturity_date_id"=>1, //antes estava 0
                "salesman_id"=> 0,
                "payment_day"=> 0,
                "discount"=>0,
                "credit_limit"=>0,
                "delivery_method_id"=>0
            ];
            \Debugbar::info($data);

            $response = Http::post($this->_endpointUrl."customers/insert/?access_token=$this->accessToken&json=true", [
                'company_id' => Setting::getParam('moloni_company_id'),
                "vat"=>$vat,
                "number"=>$number,
                "name"=>$name,
                "language_id"=>1,
                "address"=>empty($address) ? "Desconhecido" : $address,
                "zip_code"=>empty($zip) ? "0000-000" : $zip,
                "city"=>empty($city) ? "Desconhecido" : $city,
                "country_id"=>1,
                "email"=>$email,
                //"payment_method_id"=> Setting::getParam('moloni_mb_payment_id'), //antes estava 0
                "payment_method_id"=> 1,
                "maturity_date_id"=>1, //antes estava 0
                "salesman_id"=> 0,
                "payment_day"=> 0,
                "discount"=>0,
                "credit_limit"=>0,
                "delivery_method_id"=>0
            ]);
            return $this->checkValidResponse($response);
        }
    }

    /**
     * Get or create a new customer, should return the customer id or false if something went wrong
     * @param type $name
     * @param type $vat
     * @param type $number
     * @param type $address
     * @param type $zip
     * @param type $city
     * @param type $email
     * @return boolean | integer
     */
    public function getOrInsertCustomer($name, $number, $address, $city , $vat='999999990' ,$zip=null, $email = null){
        $customerId=null;
        if(($customers = $this->getCustomerByNumber($number)) == false){
            \Debugbar::error("Não achou cliente");
            //Validator::validateFormat("PT$vat")
            if(empty($vat) || $vat=="999999990" || ($customers = $this->getCustomerByVat($vat)) == false){
                \Debugbar::error("Entrou com zip |$zip|");
                \Debugbar::info("Dados para criar $name, $vat, $number, $address, $zip, $city, $email");
                //create a user
                if(($data = $this->insertCustomer($name, $number, $address, $city, $vat, $zip, $email)) == false){
                    \Debugbar::error($data);
                    return false;
                }else{
                    if(empty($data['valid'])){
                        \Debugbar::error("Falhou criação de user1");
                        flash("Ocorreram os seguintes erros:".json_encode($data))->error()->overlay();
                    }else{
                        \Debugbar::error("correu bem");
                    }

                    \Debugbar::error($data);
                    return isset($data['customer_id']) ? $data['customer_id'] : false;
                }

            }else{
                foreach($customers as $customer){
                    if($customer['vat'] == $vat){
                        return $customer['customer_id'];
                    }
                }
            }
        }else{
            foreach($customers as $customer){
                if($customer['number'] == $number){
                    return $customer['customer_id'];
                }
            }
        }
        if($customerId == null){
            //create a user
            if(($data = $this->insertCustomer($name, $number, $address, $city, $vat, $zip, $email)) == false){
                \Debugbar::error($data);
                return false;
            }else{
                if(empty($data['valid'])){
                    \Debugbar::error("Falhou criação de user0");
                    flash("Ocorreram os seguintes erros:".json_encode($data))->error()->overlay();
                }else{
                    \Debugbar::error("correu bem");
                }
                return isset($data['customer_id']) ? $data['customer_id'] : false;
            }
        }
    }

    /**
     * Get all document types
     * @return boolean or array
     */
    public function getAllDocumentTypes(){
        if($this->getToken() == false){
            return false;
        }else{
            $response = Http::post($this->_endpointUrl."documents/getAllDocumentTypes/?access_token=$this->accessToken&json=true", [
                'language_id' => 1
            ]);
            return $this->checkValidResponse($response);
        }
    }

    /**
     * Get all document
     * @param integer $offset
     * @return boolean or array
     */
    public function getAllDocuments($offset = 0){
        if($this->getToken() == false){
            return false;
        }else{
            $response = Http::post($this->_endpointUrl."documents/getAll/?access_token=$this->accessToken&json=true", [
                'company_id' => Setting::getParam('moloni_company_id'),
                'offset' => $offset
            ]);
            return $this->checkValidResponse($response);
        }
    }

    /**
     * Get all document sets
     * @param integer $offset
     * @return boolean or array
     */
    public function getAllDocumentSets($offset = 0){
        if($this->getToken() == false){
            return false;
        }else{
            $response = Http::post($this->_endpointUrl."documentSets/getAll/?access_token=$this->accessToken&json=true", [
                'company_id' => Setting::getParam('moloni_company_id'),
                'offset' => $offset
            ]);
            return $this->checkValidResponse($response);
        }
    }

    /**
     * Get all payment methods
     * @param integer $offset
     * @return boolean or array
     */
    public function getAllPaymentMethods($offset = 0){
        if($this->getToken() == false){
            return false;
        }else{
            $response = Http::post($this->_endpointUrl."paymentMethods/getAll/?access_token=$this->accessToken&json=true", [
                'company_id' => Setting::getParam('moloni_company_id'),
                'offset' => $offset
            ]);
            return $this->checkValidResponse($response);
        }
    }

    /**
     * Get all categories, we can select the parent category id
     * @param type $parentId
     * @return boolean or array
     */
    public function getAllCategories($parentId = 0){
        if($this->getToken() == false){
            return false;
        }else{
            $response = Http::post($this->_endpointUrl."productCategories/getAll/?access_token=$this->accessToken&json=true", [
                'company_id' => Setting::getParam('moloni_company_id'),
                'parent_id' => $parentId
            ]);
            return $this->checkValidResponse($response);
        }
    }

    /**
     * Get all porducts of a category
     * @param type $parentId
     * @param integer $offset
     * @return boolean or array
     */
    public function getAllProductsOfCategory($categoryId, $offset = 0){
        if($this->getToken() == false){
            return false;
        }else{
            $response = Http::post($this->_endpointUrl."products/getAll/?access_token=$this->accessToken&json=true", [
                'company_id' => Setting::getParam('moloni_company_id'),
                'category_id' => $categoryId,
                'offset' => $offset
            ]);
            return $this->checkValidResponse($response);
        }
    }

    /**
     * Get all taxes
     * @return boolean or array
     */
    public function getAllTaxes(){
        if($this->getToken() == false){
            return false;
        }else{
            $response = Http::post($this->_endpointUrl."invoices/insert/?access_token=$this->accessToken&json=true", [
                'company_id' => Setting::getParam('moloni_company_id'),
            ]);
            return $this->checkValidResponse($response);
        }
    }

    /**
     * Create a new invoice
     * $payment = [
    {
    "payment_method_id":921423,
    "date":date('Y-m-d'),
    "value":10

    }
    ]
     * $sendEmail = [
    'email' => "Email do cliente",
    'name' => "Nome do cliente",
    'msg' => ''
    ];
     * @return boolean or array
     */
    public function insertInvoiceReceipt($customerId, $products, $payment,$orderId=null, $status=0, $sendEmail=null){

        if($this->getToken() == false){
            return false;
        }else{
            $array = [
                'company_id' => Setting::getParam('moloni_company_id'),
                'date' => date('Y-m-d'),
                'expiration_date' => date('Y-m-d'),
                'document_set_id' => Setting::getParam('moloni_document_set_id'),
                'customer_id' => $customerId,
                'our_reference' => "#$orderId",
                'products' => $products,
                "payments"=>$payment,
                'status' => $status,
                'send_email'=>$sendEmail,
            ];
            \Debugbar::info($array);
            $response = Http::post($this->_endpointUrl."invoiceReceipts/insert/?access_token=$this->accessToken&json=true", [
                'company_id' => Setting::getParam('moloni_company_id'),
                'date' => date('Y-m-d'),
                'expiration_date' => date('Y-m-d'),
                'document_set_id' => Setting::getParam('moloni_document_set_id'),
                'customer_id' => $customerId,
                'our_reference' => "#$orderId",
                'products' => $products,
                "payments"=>$payment,
                'status' => $status,
                'send_email'=>$sendEmail,
            ]);
            return $this->checkValidResponse($response);
        }
    }

    /**
     * Get all the document sets
     * @return array|false
     */
    public function getDocumentSets(){
        if($this->getToken() == false){
            return false;
        }else{
            $response = Http::post($this->_endpointUrl."documentSets/getAll/?access_token=$this->accessToken&json=true", [
                'company_id' => Setting::getParam('moloni_company_id'),
            ]);
            return $this->checkValidResponse($response);
            $client = new Client();
        }
    }

    /**
     * Get the pdf link for a document
     * @param $documentId
     * @return array|false
     */
    public function getPDFLink($documentId){
        if($this->getToken() == false){
            return false;
        }else{
            $response = Http::post($this->_endpointUrl."documents/getPDFLink/?access_token=$this->accessToken&json=true", [
                'company_id' => Setting::getParam('moloni_company_id'),
                'document_id' => $documentId
            ]);
            return $this->checkValidResponse($response);
            $client = new Client();
        }
    }

    /**
     * Check is the response is valid else reset tokens
     * @param $response
     * @return false|array
     */
    public function checkValidResponse($response){
        if ($response->successful()) {
            \Debugbar::info($response);
            $data = $response->json();
            \Debugbar::info($data);
            if(!empty($data['error'])){
                \Debugbar::info("Deu erro 1");
                if($data['error'] == 'invalid_request' && $data['error_description'] == 'Invalid access token.'){
                    Cache::forget('moloni_access_token');
                    Cache::forget('moloni_expire_access_token');
                    $this->accessToken = null;
                }
                return false;
            }else{
                return $data;
            }
        }else{
            \Debugbar::error("Deu erro");
            \Debugbar::error($response);

            return false;
        }
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


}
