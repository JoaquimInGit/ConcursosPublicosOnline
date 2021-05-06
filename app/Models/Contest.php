<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\LoadDefaults;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class Contest
 * @package App\Models
 * @version May 6, 2021, 2:35 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $contestsEntities
 * @property \Illuminate\Database\Eloquent\Collection $contestsFilters
 * @property string $num_announcement
 * @property string $description
 * @property string $entity
 * @property boolean $type_act
 * @property integer $type_model
 * @property integer $type_contract
 * @property number $price
 * @property string $publication_date
 * @property string $deadline
 * @property integer $state
 * @property string $republic_diary
 * @property string $cpv
 * @property string $cpv_description
 * @property string $procedure_parts
 * @property string $pdf_content
 */
class Contest extends Model implements Auditable
{
    use LoadDefaults;
    use \OwenIt\Auditing\Auditable;

    public $table = 'contests';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const STATE_DISABLED = 0;
    const STATE_ENABLED = 1;


    public $fillable = [
        'num_announcement',
        'description',
        'entity',
        'type_act',
        'type_model',
        'type_contract',
        'price',
        'publication_date',
        'deadline',
        'state',
        'republic_diary',
        'cpv',
        'cpv_description',
        'procedure_parts',
        'pdf_content'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'num_announcement' => 'string',
        'description' => 'string',
        'entity' => 'string',
        'type_act' => 'boolean',
        'type_model' => 'integer',
        'type_contract' => 'integer',
        'price' => 'decimal:2',
        'publication_date' => 'date',
        'deadline' => 'string',
        'state' => 'integer',
        'republic_diary' => 'string',
        'cpv' => 'string',
        'cpv_description' => 'string',
        'procedure_parts' => 'string',
        'pdf_content' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'num_announcement' => 'required|string|max:255',
        'description' => 'required|string',
        'entity' => 'required|string|max:255',
        'type_act' => 'nullable|boolean',
        'type_model' => 'required',
        'type_contract' => 'required',
        'price' => 'nullable|numeric',
        'publication_date' => 'required',
        'deadline' => 'required|string|max:255',
        'state' => 'required',
        'republic_diary' => 'required|string|max:255',
        'cpv' => 'required|string|max:255',
        'cpv_description' => 'required|string',
        'procedure_parts' => 'nullable|string|max:255',
        'pdf_content' => 'nullable|string',
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
        'num_announcement' => __('Num Announcement'),
        'description' => __('Description'),
        'entity' => __('Entity'),
        'type_act' => __('Type Act'),
        'type_model' => __('Type Model'),
        'type_contract' => __('Type Contract'),
        'price' => __('Price'),
        'publication_date' => __('Publication Date'),
        'deadline' => __('Deadline'),
        'state' => __('State'),
        'republic_diary' => __('Republic Diary'),
        'cpv' => __('Cpv'),
        'cpv_description' => __('Cpv Description'),
        'procedure_parts' => __('Procedure Parts'),
        'pdf_content' => __('Pdf Content'),
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
    public function contestsEntities()
    {
        return $this->hasMany(\App\Models\ContestsEntity::class, 'contest_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function contestsFilters()
    {
        return $this->hasMany(\App\Models\ContestsFilter::class, 'contest_id');
    }

    public static function getStatusArray()
    {
        return [
            self::STATE_DISABLED =>  __('Disabled'),
            self::STATE_ENABLED =>  __('Approved'),
        ];
    }

    public function getStatusOptions()
    {
        return static::getStatusArray();
    }

    public function getStatusLabelAttribute()
    {
        $array = self::getStatusOptions();
        return $array[$this->state];
    }
}
