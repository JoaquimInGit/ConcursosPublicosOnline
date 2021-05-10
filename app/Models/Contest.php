<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\LoadDefaults;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * Class Contest
 * @package App\Models
 * @version May 7, 2021, 11:10 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $contestsEntities
 * @property \Illuminate\Database\Eloquent\Collection $contestsFilters
 * @property integer $base_id
 * @property string $num_announcement
 * @property string $description
 * @property string $entity
 * @property boolean $type_act
 * @property boolean $type_model
 * @property boolean $type_contract
 * @property number $price
 * @property string $publication_date
 * @property string $deadline_date
 * @property boolean $status
 * @property integer $republic_diary_num
 * @property integer $republic_diary_serie
 * @property string $cpv
 * @property string $cpv_description
 * @property string $procedure_parts
 * @property string $link_announcement
 * @property string $pdf_content
 */
class Contest extends Model implements Auditable,HasMedia
{
    use LoadDefaults;
    use \OwenIt\Auditing\Auditable;
    use InteractsWithMedia;

    public $table = 'contests';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    /**
     * ultimo registo
     * @return mixed
     */
    public static function last(){
        return static::all()->last();
    }

    /**
     * Registar uma coleção de media
     */
    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('pdfs')
            ->singleFile();
    }

    public $fillable = [
        'base_id',
        'num_announcement',
        'description',
        'entity',
        'type_act',
        'type_model',
        'type_contract',
        'price',
        'publication_date',
        'deadline_date',
        'status',
        'republic_diary_num',
        'republic_diary_serie',
        'cpv',
        'cpv_description',
        'procedure_parts',
        'link_announcement',
        'pdf_content'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'base_id' => 'integer',
        'num_announcement' => 'string',
        'description' => 'string',
        'entity' => 'string',
        'type_act' => 'boolean',
        'type_model' => 'boolean',
        'type_contract' => 'boolean',
        'price' => 'decimal:2',
        'publication_date' => 'date',
        'deadline_date' => 'date',
        'status' => 'boolean',
        'republic_diary_num' => 'integer',
        'republic_diary_serie' => 'integer',
        'cpv' => 'string',
        'cpv_description' => 'string',
        'procedure_parts' => 'string',
        'link_announcement' => 'string',
        'pdf_content' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'base_id' => 'required|integer',
        'num_announcement' => 'nullable|string|max:255',
        'description' => 'required|string',
        'entity' => 'required|string|max:255',
        'type_act' => 'nullable|boolean',
        'type_model' => 'nullable|boolean',
        'type_contract' => 'nullable|boolean',
        'price' => 'nullable|numeric',
        'publication_date' => 'required',
        'deadline_date' => 'required',
        'status' => 'required|boolean',
        'republic_diary_num' => 'nullable|integer',
        'republic_diary_serie' => 'nullable|integer',
        'cpv' => 'nullable|string|max:255',
        'cpv_description' => 'nullable|string',
        'procedure_parts' => 'nullable|string|max:255',
        'link_announcement' => 'nullable|string|max:255',
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
        'base_id' => __('Base Id'),
        'num_announcement' => __('Num Announcement'),
        'description' => __('Description'),
        'entity' => __('Entity'),
        'type_act' => __('Type Act'),
        'type_model' => __('Type Model'),
        'type_contract' => __('Type Contract'),
        'price' => __('Price'),
        'publication_date' => __('Publication Date'),
        'deadline_date' => __('Deadline Date'),
        'status' => __('Status'),
        'republic_diary_num' => __('Republic Diary Num'),
        'republic_diary_serie' => __('Republic Diary Serie'),
        'cpv' => __('Cpv'),
        'cpv_description' => __('Cpv Description'),
        'procedure_parts' => __('Procedure Parts'),
        'link_announcement' => __('Link Announcement'),
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
}
