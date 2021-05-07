<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\LoadDefaults;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class OrderItems
 * @package App\Models
 * @version May 7, 2021, 11:18 am UTC
 *
 * @property \App\Models\Contest $contest
 * @property \App\Models\Entity $entity
 * @property integer $contest_id
 * @property integer $entity_id
 * @property boolean $follow
 * @property boolean $viewed
 */
class OrderItems extends Model implements Auditable
{
    use LoadDefaults;
    use \OwenIt\Auditing\Auditable;

    public $table = 'contests_entities';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';




    public $fillable = [
        'contest_id',
        'entity_id',
        'follow',
        'viewed'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'contest_id' => 'integer',
        'entity_id' => 'integer',
        'follow' => 'boolean',
        'viewed' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'contest_id' => 'nullable',
        'entity_id' => 'nullable',
        'follow' => 'required|boolean',
        'viewed' => 'required|boolean',
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
        'contest_id' => __('Contest Id'),
        'entity_id' => __('Entity Id'),
        'follow' => __('Follow'),
        'viewed' => __('Viewed'),
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
    public function contest()
    {
        return $this->belongsTo(\App\Models\Contest::class, 'contest_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function entity()
    {
        return $this->belongsTo(\App\Models\Entity::class, 'entity_id');
    }
}
