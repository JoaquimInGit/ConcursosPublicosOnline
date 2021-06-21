<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\LoadDefaults;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class ContestFilter
 * @package App\Models
 * @version June 8, 2021, 4:05 pm UTC
 *
 * @property \App\Models\Contest $contest
 * @property \App\Models\Filter $filter
 * @property integer $contest_id
 * @property integer $filter_id
 * @property string $date
 */
class ContestFilter extends Model implements Auditable
{
    use LoadDefaults;
    use \OwenIt\Auditing\Auditable;

    public $table = 'contest_filters';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';




    public $fillable = [
        'contest_id',
        'filter_id',
        'date'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'contest_id' => 'integer',
        'filter_id' => 'integer',
        'date' => 'date'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'contest_id' => 'nullable',
        'filter_id' => 'nullable',
        'date' => 'required',
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
        'filter_id' => __('Filter Id'),
        'date' => __('Date'),
        'created_at' => __('Created At'),
        'updated_at' => __('Updated At')
        ];
    }

    /**
     * Devolve a entidade atual
     * @return mixed
     */
    public static function getEntity(){
        $entity = Entity::getCurrentEntity();
        return $entity->id;
    }

    public static function getFiltersEntity($entity){
        $filters = Filter::where('entity_id', $entity)->get()->toArray();
        $filters = json_encode($filters);
        return json_decode($filters);
        //console.log($filters);
        //dd($filters);
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
    public function filter()
    {
        return $this->belongsTo(\App\Models\Filter::class, 'filter_id');
    }
}
