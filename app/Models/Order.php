<?php

namespace App\Models;

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
}
