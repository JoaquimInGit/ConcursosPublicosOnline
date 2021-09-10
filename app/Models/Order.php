<?php

namespace App\Models;

use App\Facades\Eupago;
use App\Facades\Setting;
use Carbon\Carbon;
use Carbon\Doctrine\DateTimeDefaultPrecision;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\LoadDefaults;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class Order
 * @package App\Models
 * @version June 17, 2021, 2:26 pm UTC
 *
 * @property \App\Models\Entity $entity
 * @property \App\Models\User $user
 * @property \Illuminate\Database\Eloquent\Collection $orderItems
 * @property integer $entity_id
 * @property integer $user_id
 * @property string $name
 * @property string $email
 * @property string $address
 * @property string $zip_code
 * @property string $mobile_phone
 * @property string $nif
 * @property string $coupon
 * @property number $discount
 * @property number $sub_total
 * @property number $iva_value
 * @property boolean $payment_method
 * @property string $notes
 * @property string $mb_entity
 * @property string $mb_ref
 * @property string $mb_limit_date
 * @property string $mbway_ref
 * @property string $mbway_alias
 * @property string $payment_ref
 * @property string $invoice_id
 * @property string $invoice_link
 * @property string $payment_limit_date
 * @property integer $invoice_status
 * @property integer $status
 */
class Order extends Model implements Auditable
{
    use LoadDefaults;
    use \OwenIt\Auditing\Auditable;

    public $table = 'orders';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    const STATUS_CANCELED = 0;
    CONST STATUS_WAITING_PAYMENT = 1;
    CONST STATUS_PAYED = 2;

    const PAYMENT_METHOD_MBREF = 0;
    CONST PAYMENT_METHOD_PAYPAL = 1;
    CONST PAYMENT_METHOD_MBWAY = 2;

    const INVOICE_STATUS_WAITING_EMISSION = 0;
    const INVOICE_STATUS_DRAFT = 1;
    const INVOICE_STATUS_FINAL = 2;
    const INVOICE_STATUS_CANCELED = 3;


    public $fillable = [
        'entity_id',
        'user_id',
        'name',
        'email',
        'address',
        'zip_code',
        'mobile_phone',
        'nif',
        'coupon',
        'discount',
        'sub_total',
        'iva_value',
        'payment_method',
        'notes',
        'mb_entity',
        'mb_ref',
        'mb_limit_date',
        'mbway_ref',
        'mbway_alias',
        'payment_ref',
        'invoice_id',
        'invoice_link',
        'payment_limit_date',
        'invoice_status',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'entity_id' => 'integer',
        'user_id' => 'integer',
        'name' => 'string',
        'email' => 'string',
        'address' => 'string',
        'zip_code' => 'string',
        'mobile_phone' => 'string',
        'nif' => 'string',
        'coupon' => 'string',
        'discount' => 'decimal:2',
        'sub_total' => 'decimal:2',
        'iva_value' => 'decimal:2',
        'payment_method' => 'boolean',
        'notes' => 'string',
        'mb_entity' => 'string',
        'mb_ref' => 'string',
        'mb_limit_date' => 'date',
        'mbway_ref' => 'string',
        'mbway_alias' => 'string',
        'payment_ref' => 'string',
        'invoice_id' => 'string',
        'invoice_link' => 'string',
        'payment_limit_date' => 'date',
        'invoice_status' => 'integer',
        'status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'entity_id' => 'nullable',
        'user_id' => 'nullable',
        'name' => 'required|string|max:255',
        'email' => 'required|string|max:255',
        'address' => 'nullable|string|max:255',
        'zip_code' => 'nullable|string|max:255',
        'mobile_phone' => 'nullable|string|max:32',
        'nif' => 'nullable|string|max:32',
        'coupon' => 'nullable|string|max:64',
        'discount' => 'nullable|numeric',
        'sub_total' => 'required|numeric',
        'iva_value' => 'required|numeric',
        'payment_method' => 'required|boolean',
        'notes' => 'nullable|string|max:255',
        'mb_entity' => 'nullable|string|max:5',
        'mb_ref' => 'nullable|string|max:9',
        'mb_limit_date' => 'nullable',
        'mbway_ref' => 'nullable|string|max:25',
        'mbway_alias' => 'nullable|string|max:32',
        'payment_ref' => 'nullable|string|max:64',
        'invoice_id' => 'nullable|string|max:64',
        'invoice_link' => 'nullable|string|max:255',
        'payment_limit_date' => 'nullable',
        'invoice_status' => 'nullable',
        'status' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    /**
     * Attribute labels
     *
     * @return array
     */
    public static function attributeLabels()
    {
        return [
            'id' => __('Id'),
            'entity_id' => __('Entity Id'),
            'user_id' => __('User Id'),
            'name' => __('Name'),
            'email' => __('Email'),
            'address' => __('Address'),
            'zip_code' => __('Zip Code'),
            'mobile_phone' => __('Mobile Phone'),
            'nif' => __('Nif'),
            'coupon' => __('Coupon'),
            'discount' => __('Discount'),
            'sub_total' => __('Sub Total'),
            'iva_value' => __('Iva Value'),
            'payment_method' => __('Payment Method'),
            'notes' => __('Notes'),
            'mb_entity' => __('Mb Entity'),
            'mb_ref' => __('Mb Ref'),
            'mb_limit_date' => __('Mb Limit Date'),
            'mbway_ref' => __('Mbway Ref'),
            'mbway_alias' => __('Mbway Alias'),
            'payment_ref' => __('Payment Ref'),
            'invoice_id' => __('Invoice Id'),
            'invoice_link' => __('Invoice Link'),
            'payment_limit_date' => __('Payment Limit Date'),
            'invoice_status' => __('Invoice Status'),
            'status' => __('Status'),
            'created_at' => __('Created At'),
            'updated_at' => __('Updated At'),
        ];
    }

    /**
     * Return the attribute label
     * @param string $attribute
     * @return string
     */
    public function getAttributeLabel($attribute){
        $attributeLabels = static::attributeLabels();
        return isset($attributeLabels[$attribute]) ? $attributeLabels[$attribute] : __($attribute);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function entity()
    {
        return $this->belongsTo(\App\Models\Entity::class, 'entity_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function orderItems()
    {
        return $this->hasMany(\App\Models\OrderItem::class, 'order_id');
    }

    /**
     * recebe a entidade atual
     * @return mixed
     */
    public function getEntity(){
        $entity = Entity::getCurrentEntity();
        return $entity;
    }

    /**
     * recebe o user atual
     * @return mixed
     */
    public function getUser(){
        $user = User::where('id',auth()->user()->id)->first();
        return $user;
    }

    /**
     * recebe os produtos e devolve um array com o preço dos produtos
     * @return array
     */
    public static function getPrice(){
        $array = array();
        $produtos = Product::select('price')->get();
       // dd($produtos);
        foreach ($produtos as $produto){
            $preco = floatval($produto->price);
            array_push($array,$preco);
        }
        //dd($array);
        return $array;
    }

    /**
     * devolve o preco sem iva dado o indice do produto
     * @param $index
     * @return mixed
     */
    public static function getSpecificPrice($index){
        //dd($index);
        $array = Order::getPrice();
        //ddd($array[$index]);
        return $array[$index];
    }

    /**
     * devolve o preco com iva dado o indice do produto
     * @param $index
     * @return string
     */
    public static function getSpecificPriceIVA($index){
        $array = Order::getPrice();
        $dif = $array[$index]*0.23;
        $precofinal = $array[$index] + $dif;
        return number_format($precofinal,1);
    }

    /**
     * cria um order item
     * @param $order
     * @param $product
     */
    public function syncOrderItems($order,$product){
       //ddd($product);
        OrderItem::create([
            'entity_id' => Order::getEntity()->id,
            'order_id' => $order->id,
            'product_id' => $product,
            'name' => Order::getUser()->name,
            'quantity' => 1,
            'price' => Order::getSpecificPrice($product -1),
            'iva' => Order::getSpecificPriceIVA($product -1),
        ]);

    }

    /**
     * função para gerar referencias de multibanco
     * @param null $dateLimit
     * @param false $autoSave
     * @param false $forceCreation
     * @return bool
     */
    public function generateMB($dateLimit = null, $autoSave = false, $forceCreation = false){
        if(empty($this->mb_entity) || $forceCreation == true) {
            $response = Eupago::generateReferenceMB($this->id, $this->iva_value, $dateLimit);
            if (Eupago::checkValidResponse($response)) {
                $this->mb_entity = $response->entidade;
                $this->mb_ref = $response->referencia;
                $this->mb_limit_date = $dateLimit;
                if ($autoSave)
                    return $this->saveQuietly();
            } else {
                return false;
            }
        }else{
            return true; //already exist a mb
        }
    }

    /**
     * Generate a MBWay and if autosave is ativated automatically save the order
     * @param string $phone
     * @param bool $autoSave
     * @return bool
     */
    public function generateMBWay($phone, $autoSave = false){
        $response = Eupago::generateMBWay($this->id, $this->iva_value,$phone,'Pagamento Concursos');
        if (Eupago::checkValidResponse($response)) {
            $this->mbway_ref = $response->referencia;
            $this->mbway_alias = $response->alias;
            if ($autoSave)
                return $this->saveQuietly();
        } else {
            return false;
        }
    }

    public function payments()
    {
        return $this->hasMany(\App\Models\Payment::class, 'order_id');
    }

    public static function getStatusArray()
    {
        return [
            self::STATUS_CANCELED =>  __('Canceled'),
            self::STATUS_WAITING_PAYMENT =>  __('Waiting payment'),
            self::STATUS_PAYED =>  __('Payed'),
        ];
    }

    public function getStatusOptions()
    {
        return static::getStatusArray();
    }

    public function getStatusLabelAttribute()
    {
        $array = self::getStatusOptions();
        return $array[$this->status];
    }

    public static function getPaymentMethodArray()
    {
        return [
            self::PAYMENT_METHOD_MBREF =>  __('Referência Multibanco'),
            self::PAYMENT_METHOD_PAYPAL =>  __('Paypal'),
            self::PAYMENT_METHOD_MBWAY =>  __('MBWay'),
        ];
    }

    public function getPaymentMethodOptions()
    {
        return static::getPaymentMethodArray();
    }

    public function getPaymentMethodLabelAttribute()
    {
        $array = self::getPaymentMethodOptions();
        return $array[$this->payment_method];
    }

    public static function getInvoiceStatusArray()
    {
        return [
            self::INVOICE_STATUS_WAITING_EMISSION =>  __('Waiting Emission'),
            self::INVOICE_STATUS_DRAFT =>  __('Draft'),
            self::INVOICE_STATUS_FINAL =>  __('Final'),
            self::INVOICE_STATUS_CANCELED =>  __('Canceled'),
        ];
    }

    public function getInvoiceStatusOptions()
    {
        return static::getInvoiceStatusArray();
    }

    public function getInvoiceStatusLabelAttribute()
    {
        $array = self::getInvoiceStatusOptions();
        return $array[$this->invoice_status];
    }

    /**
     * recebe o id da entidade por parametro e devolve a entidade
     * @param $entityid
     * @return mixed
     */
    public function getEntityParam($entityid){
        $entity = Entity::where('id',$entityid)->first();
        return $entity;
    }

    /**
     * recebe o id do user por parametro e devolve a user
     * @param $userid
     * @return mixed
     */
    public function getUserParam($userid){
        $user = User::where('id',$userid)->first();
        return $user;
    }

    /**
     * devolve a parte do lado esquerdo do email
     * @param $userid
     * @return string
     */
    public function getUsername($userid){
        $user = User::where('id',$userid)->first();
        $username = strtok($user->email, '@');
        return $username;
    }

    /**
     * função que é chamada quando uma order é paga
     * @param Order $order
     */
    public static function changeOnPayment(Order $order){
        $enddate = OrderItem::where('entity_id', $order->entity_id)
            ->where('status', 2)
            ->orderBy('end_date', 'desc')->first();
        //ddd($order);
        // $orderItem = OrderItem::where('order_id', $order->id)->first();
        //ddd($orderItem->product_id == 1);
        //se a data de fim de pagamento for anterior ao dia de hoje
        //ddd($enddate->end_date > Carbon::today());
        if ($enddate != null && $enddate->end_date > Carbon::today()) {
            // ddd($enddate->end_date > Carbon::today());
            if ($order->status == 2) {
                $orderItem = OrderItem::where('order_id', $order->id)->first();
                if ($orderItem->product_id == 1) {
                    $orderItem->update(['start_date' => $enddate->end_date, 'end_date' => $enddate->end_date->addMonth(), 'status' => 2]);
                } elseif ($orderItem->product_id == 2) {
                    $orderItem->update(['start_date' => $enddate->end_date, 'end_date' => $enddate->end_date->addQuarters(2), 'status' => 2]);
                } elseif ($orderItem->product_id == 3) {
                    $orderItem->update(['start_date' => $enddate->end_date, 'end_date' => $enddate->end_date->addYear(), 'status' => 2]);
                }
            }
        } else {
            //  ddd($enddate->end_date > Carbon::today());
            if ($order->status == 2) {

                $orderItem = OrderItem::where('order_id', $order->id)->first();
                //ddd(($order->status == 2).' '.$orderItem);
                $lastPayedOrder = Order::where('status',Order::STATUS_PAYED)->where('entity_id',$order->entity_id)->orderBy('created_at','DESC')->first();
                $flag = false;
                if ($orderItem->product_id == 1) {
                    if(!empty($lastPayedOrder) && !empty($lastPayedOrder->orderItems()->first()) && Carbon::today()->lessThan(Carbon::parse($lastPayedOrder->orderItems()->first()->end_date))){
                        $orderItem->update(['start_date' => Carbon::parse($lastPayedOrder->orderItems()->first()->end_date)->addDay(), 'end_date' => Carbon::parse($lastPayedOrder->orderItems()->first()->end_date)->addDay()->addMonth(), 'status' => 2]);
                    }else{
                        $orderItem->update(['start_date' => Carbon::today(), 'end_date' => Carbon::today()->addMonth(), 'status' => 2]);
                    }
                    $flag = true;
                } elseif ($orderItem->product_id == 2) {
                    if(!empty($lastPayedOrder) && !empty($lastPayedOrder->orderItems()->first()) && Carbon::today()->lessThan(Carbon::parse($lastPayedOrder->orderItems()->first()->end_date))){
                        $orderItem->update(['start_date' => Carbon::parse($lastPayedOrder->orderItems()->first()->end_date)->addDay(), 'end_date' => Carbon::parse($lastPayedOrder->orderItems()->first()->end_date)->addDay()->addQuarters(), 'status' => 2]);
                    }else{
                        $orderItem->update(['start_date' => Carbon::today(), 'end_date' => Carbon::today()->addQuarters(), 'status' => 2]);
                    }
                    $flag = true;
                } elseif ($orderItem->product_id == 3) {
                    if(!empty($lastPayedOrder) && !empty($lastPayedOrder->orderItems()->first()) && Carbon::today()->lessThan(Carbon::parse($lastPayedOrder->orderItems()->first()->end_date))){
                        $orderItem->update(['start_date' => Carbon::parse($lastPayedOrder->orderItems()->first()->end_date)->addDay(), 'end_date' => Carbon::parse($lastPayedOrder->orderItems()->first()->end_date)->addDay()->addYear(), 'status' => 2]);
                    }else{
                        $orderItem->update(['start_date' => Carbon::today(), 'end_date' => Carbon::today()->addYear(), 'status' => 2]);
                    }
                    $flag = true;
                }
                if($flag){
                    $entity = Entity::where('id', $order->entity_id)->first();
                    $entity->update(['status' => 1]);
                }
            }

        }
    }

    public static function createNewSubscription($order,$item){
        $newOrder = $order->replicate();
        $newOrder->status = Order::STATUS_WAITING_PAYMENT;
        $newOrder->mb_entity = null;
        $newOrder->mb_ref = null;
        $newOrder->mb_limit_date = null;
        $newOrder->mbway_ref = null;
        $newOrder->mbway_alias = null;
        $newOrder->payment_ref = null;
        $newOrder->payment_limit_date = null;
        $newOrder->invoice_status = null;
        $newOrder->invoice_id = null;
        $newOrder->invoice_link = null;
        if($newOrder->save()){
            $newItem = $item->replicate();
            $newItem->order_id = $newOrder->id;
            $newItem->status = 1;
            $newItem->start_date = null;
            $newItem->end_date = null;
            if($newItem->save()){
                return true;
            }
        }
        return false;
    }

    /**
     * Cria uma nova fatura, valida-a automaticamente e envia por email ao cliente
     * @return boolean
     */
    public function createInvoice(){

        $items = [];
        foreach($this->orderItems as $orderItem){
            if($orderItem->price > 0){
                //if is withour vet use execption M07
                $items[] = [
                    "product_id" => Setting::getParam('moloni_product_id'),
                    'name' => $orderItem->product->description,
                    "summary" => "",
                    "price" => $orderItem->price,//$this->subtotal,1.23
                    "qty" => $orderItem->quantity,
                    'taxes' => [
                        [
                            "tax_id"=> Setting::getParam('moloni_23_tax_id'),
                        ]
                    ]
                ];
            }
        }
        $zip = null;
        \Debugbar::error("ZIP |$this->zip_code|");
        if(preg_match ( '/^\d{4}-\d{3}$/' , $this->zip_code)){
            $zip = $this->zip_code;
            \Debugbar::error("Entrou no zip");
        }
        $payment = [
            [
                "payment_method_id"=>1036474,
                "date"=>date('Y-m-d'),
                "value"=>$this->iva_value
            ]
        ];

        if(($customerId = Moloni::getOrInsertCustomer($this->entity->name, "#$this->id", $this->address, 'x', empty($this->nif) ? '999999990' : $this->nif , $zip, $this->email)) != false){
            \Debugbar::info("Vai agora criar a fatura");
            $invoice = Moloni::insertInvoiceReceipt($customerId, $items, $payment,$this->id, 1, true); //1 - invoice final | 0- invoice draft
            if(isset($invoice['valid']) && $invoice['valid'] == 1){
                $this->invoice_id = $invoice['document_id'];
                $this->invoice_status = self::INVOICE_STATUS_FINAL;
                $pdfData = Moloni::getPDFLink($this->invoice_id);
                if(!empty($pdfData['url'])){
                    $this->invoice_link = $pdfData['url'];
                }
                if($this->save()){
                    if($this->invoice_status == self::INVOICE_STATUS_FINAL){
                        //send ans email with the invoice for the client email
                        flash('Fatura criada com sucesso')->success()->overlay();
                        /*if($this->sendEmailInvoice()){
                            //everything is ok send an email
                            return true;
                        }else{
                            //failed to sent an email with the invoice
                            \Yii::$app->session->setFlash('danger', "Falhou envio do email");
                            $this->sendEmailToAdmin("Falhou o envio do email com a fatura", "Ocorreu um erro ao tentar enviar o email com a fatura id=$this->id para o cliente.");
                            return false;
                        }*/
                        return true;
                    }else{
                        flash('Fatura não ficou no estado final')->error()->overlay();
                        //avisar que por algum motivo não foi possivel colocar a fatura com o estado final
                        //$this->sendEmailToAdmin("Não foi possivel alterar o estado da fatura", "Ocorreu um erro ao tentar alterar o estado da fatura id=$this->id.");
                        return false;
                    }
                }else{
                    flash('A fatura foi gerada, mas não foi possivel gravar no sistema. Não volte a emitir a fatura caso contrário poderá ficar duplicada.')->error()->overlay();
                    return false;
                }

            }else{
                flash('Fatura não foi emitida. Devido a um erro.')->error()->overlay();
                return false;
            }

        }else{
            flash('Não foi possivel encontrar ou criar um novo cliente no programa de faturação.')->error()->overlay();
            return false;
        }

    }


}
