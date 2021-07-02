<?php

namespace App\Models;

use App\Facades\Eupago;
use Carbon\Carbon;
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
        'updated_at' => __('Updated At')
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
        foreach ($produtos as $produto){
            $preco = floatval($produto->price);
            array_push($array,$preco);
        }
        return $array;
    }

    /**
     * devolve o preco sem iva dado o indice do produto
     * @param $index
     * @return mixed
     */
    public static function getSpecificPrice($index){
        $array = Order::getPrice();
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

    public function syncOrderItems($order,$product){
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
    $response = Eupago::generateMBWay($this->id, $this->total,$phone,'Pagamento Concursos');
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
}
