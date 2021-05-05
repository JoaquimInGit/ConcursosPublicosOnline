<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\LoadDefaults;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class Contest
 * @package App\Models
 * @version May 4, 2021, 6:38 pm UTC
 *
 * @property string $num_announcement
 * @property string $description
 * @property string $entity
 * @property integer $type_act
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
        'type_act' => 'integer',
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
        'type_act' => 'required',
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

    
}
