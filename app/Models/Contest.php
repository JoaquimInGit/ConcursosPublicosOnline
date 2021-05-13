<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\LoadDefaults;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class Contest
 * @package App\Models
 * @version May 13, 2021, 11:17 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $contestEntities
 * @property \Illuminate\Database\Eloquent\Collection $contestFilters
 * @property integer $base_id
 * @property string $num_announcement
 * @property string $description
 * @property string $entity
 * @property number $price
 * @property string $publication_date
 * @property string $deadline_date
 * @property string $proposal_time_limit
 * @property integer $republic_diary_num
 * @property integer $republic_diary_serie
 * @property string $cpv
 * @property string $cpv_description
 * @property string $procedure_parts
 * @property string $link_announcement
 * @property string $pdf_content
 * @property boolean $type_act
 * @property boolean $type_model
 * @property boolean $type_contract
 * @property boolean $status
 */
class Contest extends Model implements Auditable
{
    use LoadDefaults;
    use \OwenIt\Auditing\Auditable;

    public $table = 'contests';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';




    public $fillable = [
        'base_id',
        'num_announcement',
        'description',
        'entity',
        'price',
        'publication_date',
        'deadline_date',
        'proposal_time_limit',
        'republic_diary_num',
        'republic_diary_serie',
        'cpv',
        'cpv_description',
        'procedure_parts',
        'link_announcement',
        'pdf_content',
        'type_act',
        'type_model',
        'type_contract',
        'status'
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
        'price' => 'decimal:2',
        'publication_date' => 'date',
        'deadline_date' => 'date',
        'proposal_time_limit' => 'string',
        'republic_diary_num' => 'integer',
        'republic_diary_serie' => 'integer',
        'cpv' => 'string',
        'cpv_description' => 'string',
        'procedure_parts' => 'string',
        'link_announcement' => 'string',
        'pdf_content' => 'string',
        'type_act' => 'boolean',
        'type_model' => 'boolean',
        'type_contract' => 'boolean',
        'status' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'base_id' => 'required|integer',
        'num_announcement' => 'nullable|string|max:255',
        'description' => 'nullable|string',
        'entity' => 'nullable|string|max:255',
        'price' => 'nullable|numeric',
        'publication_date' => 'nullable',
        'deadline_date' => 'nullable',
        'proposal_time_limit' => 'nullable|string|max:255',
        'republic_diary_num' => 'nullable|integer',
        'republic_diary_serie' => 'nullable|integer',
        'cpv' => 'nullable|string|max:255',
        'cpv_description' => 'nullable|string',
        'procedure_parts' => 'nullable|string|max:255',
        'link_announcement' => 'nullable|string|max:255',
        'pdf_content' => 'nullable|string',
        'type_act' => 'nullable|boolean',
        'type_model' => 'nullable|boolean',
        'type_contract' => 'nullable|boolean',
        'status' => 'required|boolean',
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
        'price' => __('Price'),
        'publication_date' => __('Publication Date'),
        'deadline_date' => __('Deadline Date'),
        'proposal_time_limit' => __('Proposal Time Limit'),
        'republic_diary_num' => __('Republic Diary Num'),
        'republic_diary_serie' => __('Republic Diary Serie'),
        'cpv' => __('Cpv'),
        'cpv_description' => __('Cpv Description'),
        'procedure_parts' => __('Procedure Parts'),
        'link_announcement' => __('Link Announcement'),
        'pdf_content' => __('Pdf Content'),
        'type_act' => __('Type Act'),
        'type_model' => __('Type Model'),
        'type_contract' => __('Type Contract'),
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
    public function contestEntities()
    {
        return $this->hasMany(\App\Models\ContestEntity::class, 'contest_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function contestFilters()
    {
        return $this->hasMany(\App\Models\ContestFilter::class, 'contest_id');
    }
    /*
 * retira da BD o base_id com maior valor
 */
    public static function getLastBaseId(){

        return DB::table('contests')->latest()->pluck('base_id')->max();
    }

    public static function typeActConverter($typeAct){
        switch ($typeAct){
            //case 'Todos':
              //  return 0;
            case 'Anúncio de procedimento':
                return 1;
            case 'Anúncio de concurso urgente':
                return 2;
            case 'Declaração de retificação de anúncio':
                return 3;
            case 'Aviso de prorrogação de prazo':
                return 4;
            default;
                return 0;
        }
    }

    public static function typeModelConverter($typeModel)
    {
        switch ($typeModel) {
           // case 'Todos':
              //  return 0;
            case 'Concurso público':
                return 1;
            case'Concurso público urgente':
                return 2;
            case 'Concurso limitado por prévia qualificação':
                return 3;
            case 'Procedimento de negociação':
                return 4;
            case 'Diálogo concorrencial':
                return 5;
            case 'Concurso de concepção':
                return 6;
            case 'Anúncio simplificado':
                return 7;
            case 'Instituição de sistema de qualificação':
                return 8;
            case 'Intenção de celebração de empreitadas de obras publicas por concessionários que não sejam entidades adjudicantes':
                return 9;
            case 'Parceria para a inovação':
                return 10;
            case 'Concurso de ideias':
                return 11;
            case 'Instituição de sistema de aquisição dinâmico':
                return 12;
            case 'Hasta Pública de Alienação de Bens Móveis':
                return 13;
            case 'Aquisição de Serviços Sociais e de Outros Serviços Específicos':
                return 14;
            case 'Anúncio de Adjudicação de Aquisição de Serviços Sociais e de Outros Serviços Específicos':
                return 15;
            default;
                return 0;
        }
    }

    public static function typeContractConverter($typeContract){
        switch ($typeContract){
         //   case 'Todos':
            //    return 0;
            case 'Aquisição de bens móveis':
                return 1;
            case 'Aquisição de serviços':
                return 2;
            case 'Concessão de obras públicas':
                return 3;
            case 'Concessão de serviços públicos':
                return 4;
            case 'Empreitadas de obras públicas':
                return 5;
            case 'Locação de bens móveis':
                return 6;
            case 'Sociedade':
                return 7;
            case 'Outros':
                return 8;
            default;
                return 0;
        }
    }
}
