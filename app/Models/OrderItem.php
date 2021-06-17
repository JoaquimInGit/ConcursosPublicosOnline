<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\LoadDefaults;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class OrderItem
 * @package App\Models
 * @version June 17, 2021, 2:19 pm UTC
 *
 * @property \App\Models\Entity $entity
 * @property \App\Models\Order $order
 * @property \App\Models\Product $product
 * @property integer $entity_id
 * @property integer $order_id
 * @property integer $product_id
 * @property string $cookie
 * @property string $name
 * @property integer $quantity
 * @property number $price
 * @property string $notes
 * @property number $iva
 * @property string $start_date
 * @property string $end_date
 * @property integer $status
 */
class OrderItem extends Model implements Auditable
{
    use LoadDefaults;
    use \OwenIt\Auditing\Auditable;

    public $table = 'order_item';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';




    public $fillable = [
        'entity_id',
        'order_id',
        'product_id',
        'cookie',
        'name',
        'quantity',
        'price',
        'notes',
        'iva',
        'start_date',
        'end_date',
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
        'order_id' => 'integer',
        'product_id' => 'integer',
        'cookie' => 'string',
        'name' => 'string',
        'quantity' => 'integer',
        'price' => 'decimal:2',
        'notes' => 'string',
        'iva' => 'decimal:2',
        'start_date' => 'date',
        'end_date' => 'date',
        'status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'entity_id' => 'nullable',
        'order_id' => 'nullable',
        'product_id' => 'nullable',
        'cookie' => 'nullable|string|max:255',
        'name' => 'required|string|max:255',
        'quantity' => 'required',
        'price' => 'required|numeric',
        'notes' => 'nullable|string|max:255',
        'iva' => 'required|numeric',
        'start_date' => 'nullable',
        'end_date' => 'nullable',
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
        'order_id' => __('Order Id'),
        'product_id' => __('Product Id'),
        'cookie' => __('Cookie'),
        'name' => __('Name'),
        'quantity' => __('Quantity'),
        'price' => __('Price'),
        'notes' => __('Notes'),
        'iva' => __('Iva'),
        'start_date' => __('Start Date'),
        'end_date' => __('End Date'),
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
    public function order()
    {
        return $this->belongsTo(\App\Models\Order::class, 'order_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class, 'product_id');
    }
}
