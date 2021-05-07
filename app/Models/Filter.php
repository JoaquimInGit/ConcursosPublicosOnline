<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\LoadDefaults;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class Filter
 * @package App\Models
 * @version May 7, 2021, 11:14 am UTC
 *
 * @property \App\Models\Entity $entity
 * @property \Illuminate\Database\Eloquent\Collection $contestsFilters
 * @property integer $entity_id
 * @property string $filter_name
 * @property boolean $filter_status
 * @property string $description_words
 * @property string $contest_entity
 * @property boolean $type_act
 * @property boolean $type_model
 * @property boolean $type_contract
 * @property number $min_price
 * @property number $max_price
 * @property string $cpv
 */
class Filter extends Model implements Auditable
{
    use LoadDefaults;
    use \OwenIt\Auditing\Auditable;

    public $table = 'filters';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';




    public $fillable = [
        'entity_id',
        'filter_name',
        'filter_status',
        'description_words',
        'contest_entity',
        'type_act',
        'type_model',
        'type_contract',
        'min_price',
        'max_price',
        'cpv'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'entity_id' => 'integer',
        'filter_name' => 'string',
        'filter_status' => 'boolean',
        'description_words' => 'string',
        'contest_entity' => 'string',
        'type_act' => 'boolean',
        'type_model' => 'boolean',
        'type_contract' => 'boolean',
        'min_price' => 'decimal:2',
        'max_price' => 'decimal:2',
        'cpv' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'entity_id' => 'nullable',
        'filter_name' => 'required|string|max:255',
        'filter_status' => 'nullable|boolean',
        'description_words' => 'nullable|string|max:255',
        'contest_entity' => 'nullable|string|max:255',
        'type_act' => 'nullable|boolean',
        'type_model' => 'nullable|boolean',
        'type_contract' => 'nullable|boolean',
        'min_price' => 'nullable|numeric',
        'max_price' => 'nullable|numeric',
        'cpv' => 'nullable|string|max:255',
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
        'filter_name' => __('Filter Name'),
        'filter_status' => __('Filter Status'),
        'description_words' => __('Description Words'),
        'contest_entity' => __('Contest Entity'),
        'type_act' => __('Type Act'),
        'type_model' => __('Type Model'),
        'type_contract' => __('Type Contract'),
        'min_price' => __('Min Price'),
        'max_price' => __('Max Price'),
        'cpv' => __('Cpv'),
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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function contestsFilters()
    {
        return $this->hasMany(\App\Models\ContestsFilter::class, 'filter_id');
    }
}
