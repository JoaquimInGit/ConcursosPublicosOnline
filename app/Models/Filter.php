<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\LoadDefaults;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class Filter
 * @package App\Models
 * @version May 13, 2021, 11:19 am UTC
 *
 * @property \App\Models\Entity $entity
 * @property \Illuminate\Database\Eloquent\Collection $contestFilters
 * @property integer $entity_id
 * @property string $filter_name
 * @property string $description_words
 * @property string $contest_entity
 * @property string $district
 * @property number $min_price
 * @property number $max_price
 * @property string $cpv
 * @property boolean $type_act
 * @property boolean $type_model
 * @property boolean $type_contract
 * @property boolean $filter_status
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
        'description_words',
        'contest_entity',
        'district',
        'min_price',
        'max_price',
        'cpv',
        'type_act',
        'type_model',
        'type_contract',
        'filter_status'
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
        'description_words' => 'string',
        'contest_entity' => 'string',
        'district' => 'string',
        'min_price' => 'decimal:2',
        'max_price' => 'decimal:2',
        'cpv' => 'string',
        'type_act' => 'boolean',
        'type_model' => 'boolean',
        'type_contract' => 'boolean',
        'filter_status' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'entity_id' => 'nullable',
        'filter_name' => 'required|string|max:255',
        'description_words' => 'nullable|string|max:255',
        'contest_entity' => 'nullable|string|max:255',
        'district' => 'nullable|string|max:255',
        'min_price' => 'nullable|numeric',
        'max_price' => 'nullable|numeric',
        'cpv' => 'nullable|string|max:255',
        'type_act' => 'required|boolean',
        'type_model' => 'required|boolean',
        'type_contract' => 'required|boolean',
        'filter_status' => 'required|boolean',
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
        'description_words' => __('Description Words'),
        'contest_entity' => __('Contest Entity'),
        'district' => __('District'),
        'min_price' => __('Min Price'),
        'max_price' => __('Max Price'),
        'cpv' => __('Cpv'),
        'type_act' => __('Type Act'),
        'type_model' => __('Type Model'),
        'type_contract' => __('Type Contract'),
        'filter_status' => __('Filter Status'),
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
    public function contestFilters()
    {
        return $this->hasMany(\App\Models\ContestFilter::class, 'filter_id');
    }
}