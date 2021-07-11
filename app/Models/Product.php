<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\LoadDefaults;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class Product
 * @package App\Models
 * @version June 17, 2021, 2:26 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $orderItems
 * @property string $name
 * @property number $price
 * @property number $reduced_price
 * @property string $description
 * @property string $excerpt
 * @property integer $status
 */
class Product extends Model implements Auditable
{
    use LoadDefaults;
    use \OwenIt\Auditing\Auditable;

    public $table = 'products';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    const STATUS_DELETED = -1;
    const STATUS_DISABLED = 0;
    const STATUS_ACTIVE = 1;

    public $fillable = [
        'name',
        'price',
        'reduced_price',
        'description',
        'excerpt',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'price' => 'decimal:2',
        'reduced_price' => 'decimal:2',
        'description' => 'string',
        'excerpt' => 'string',
        'status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'reduced_price' => 'nullable|numeric',
        'description' => 'nullable|string|max:255',
        'excerpt' => 'nullable|string|max:255',
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
        'name' => __('Name'),
        'price' => __('Price'),
        'reduced_price' => __('Reduced Price'),
        'description' => __('Description'),
        'excerpt' => __('Excerpt'),
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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function orderItems()
    {
        return $this->hasMany(\App\Models\OrderItem::class, 'product_id');
    }

    public static function getStatusArray()
    {
        return [
            self::STATUS_DELETED =>  __('Deleted'),
            self::STATUS_DISABLED =>  __('Disabled'),
            self::STATUS_ACTIVE =>  __('Active'),
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
