<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\LoadDefaults;
use Illuminate\Support\Facades\DB;
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

    //type_act
    const TODOS = 0;
    const ANUNCIO_PROCEDIMENTO = 1;
    const ANUNCIO_CONCURSO_URGENTE = 2;
    const DECLARACAO_RETIFICACAO_ANUNCIO = 3;
    const AVISO_PRORROCACAO_PRAZO = 4;

    //type_model
    const CONCURSO_PUBLICO = 1;
    const CONCURSOS_PUBLICO_URGENTE = 2;
    const CONCURSOS_LIMITADO_POR_PREVIA_QUALIFICACAO = 3;
    const PROCEDIMENTO_DE_NEGOCIACAO = 4;
    const DIALOGO_CONCORRENCIAL = 5;
    const CONCURSO_DE_CONCEPCAO = 6;
    const ANUNCIO_SIMPLIFICADO = 7;
    const INSTITUICAO_DE_SISTEMA_DE_QUALIFICACAO = 8;
    const INTENCAO_DE_CELEBRACAO_DE_EMPREITADAS_DE_OBRAS_PUBLICAS_POR_CONCESSIONARIOS_QUE_NAO_SEJAM_ENTIDADES_ADJUDICANTES = 9;
    const PARCERIA_PARA_A_INOVACAO = 10;
    const CONCURSO_DE_IDEIAS = 11;
    const INSTITUICAO_DE_SISTEMA_DE_AQUISICAO_DINAMICO = 12;
    const HASTA_PUBLICA_DE_ALIENACAO_DE_BENS_MOVEIS = 13;
    const AQUISICAO_DE_SERVICOS_SOCIAIS_E_DE_OUTROS_SERVICOS_ESPECIFICOS = 14;
    const ANUNCIO_DE_ADJUDICACAO_DE_AQUISICAO_DE_SERVICOS_SOCIAIS_E_DE_OUTROS_SERVICOS_ESPECIFICOS = 15;

    //type_contract
    const AQUISICAO_DE_BENS_MOVEIS = 1;
    const AQUISICAO_DE_SERVICOS = 2;
    const CONCESSAO_DE_OBRAS_PUBLICAS = 3;
    const CONCESSAO_DE_SERVICOS_PUBLICOS = 4;
    const EMPREITADAS_DE_OBRAS_PUBLICAS = 5;
    const LOCALIZACAO_DE_BENS_MOVEIS = 6;
    const TC_SOCIEDADE = 7;
    const TC_OUTROS = 8;

    //status
    const STATUS_ACTIVE = 1;
    const STATUS_OFF = 0;


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
        'type_act' => 'integer',
        'type_model' => 'integer',
        'type_contract' => 'integer',
        'status' => 'integer'
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
        'type_act' => 'nullable|integer',
        'type_model' => 'nullable|integer',
        'type_contract' => 'nullable|integer',
        'status' => 'required|integer',
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

    public static function typeActConverter($typeAct){
        switch ($typeAct){
            //case 'Todos':
              //  return 0;
            case 'An??ncio de procedimento':
                return 1;
            case 'An??ncio de concurso urgente':
                return 2;
            case 'Declara????o de retifica????o de an??ncio':
                return 3;
            case 'Aviso de prorroga????o de prazo':
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
            case 'Concurso p??blico':
                return 1;
            case'Concurso p??blico urgente':
                return 2;
            case 'Concurso limitado por pr??via qualifica????o':
                return 3;
            case 'Procedimento de negocia????o':
                return 4;
            case 'Di??logo concorrencial':
                return 5;
            case 'Concurso de concep????o':
                return 6;
            case 'An??ncio simplificado':
                return 7;
            case 'Institui????o de sistema de qualifica????o':
                return 8;
            case 'Inten????o de celebra????o de empreitadas de obras publicas por concession??rios que n??o sejam entidades adjudicantes':
                return 9;
            case 'Parceria para a inova????o':
                return 10;
            case 'Concurso de ideias':
                return 11;
            case 'Institui????o de sistema de aquisi????o din??mico':
                return 12;
            case 'Hasta P??blica de Aliena????o de Bens M??veis':
                return 13;
            case 'Aquisi????o de Servi??os Sociais e de Outros Servi??os Espec??ficos':
                return 14;
            case 'An??ncio de Adjudica????o de Aquisi????o de Servi??os Sociais e de Outros Servi??os Espec??ficos':
                return 15;
            default;
                return 0;
        }
    }

    public static function typeContractConverter($typeContract){
        switch ($typeContract){
         //   case 'Todos':
            //    return 0;
            case 'Aquisi????o de bens m??veis':
                return 1;
            case 'Aquisi????o de servi??os':
                return 2;
            case 'Concess??o de obras p??blicas':
                return 3;
            case 'Concess??o de servi??os p??blicos':
                return 4;
            case 'Empreitadas de obras p??blicas':
                return 5;
            case 'Loca????o de bens m??veis':
                return 6;
            case 'Sociedade':
                return 7;
            case 'Outros':
                return 8;
            default;
                return 0;
        }
    }

    //status
    public static function getStatusArray()
    {
        return [
            self::STATUS_ACTIVE=>  __('Ativo'),
            self::STATUS_OFF =>  __('Desativo'),
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

    //TypeAct
    public static function getTypeActArray()
    {
        return [
            self::TODOS =>  __('Todos'),
            self::ANUNCIO_PROCEDIMENTO =>  __('An??ncio de procedimento'),
            self::ANUNCIO_CONCURSO_URGENTE =>  __('An??ncio de concurso urgente'),
            self::DECLARACAO_RETIFICACAO_ANUNCIO =>  __('Declara????o de retifica????o de an??ncio'),
            self::AVISO_PRORROCACAO_PRAZO =>  __('Aviso de prorroga????o de prazo'),
        ];
    }
    public function getTypeActOptions()
    {
        return static::getTypeActArray();
    }
    public function getTypeActLabelAttribute()
    {
        $array = self::getTypeActOptions();
        return $array[$this->type_act];
    }

    //TypeModel
    public static function getTypeModelArray()
    {
        return [
            self::TODOS =>  __('Todos'),
            self::CONCURSO_PUBLICO =>  __('Concurso p??blico'),
            self::CONCURSOS_PUBLICO_URGENTE =>  __('Concurso p??blico urgente'),
            self::CONCURSOS_LIMITADO_POR_PREVIA_QUALIFICACAO =>  __('Concurso limitado por pr??via qualifica????o'),
            self::PROCEDIMENTO_DE_NEGOCIACAO =>  __('Procedimento de negocia????o'),
            self::DIALOGO_CONCORRENCIAL =>  __('Di??logo concorrencial'),
            self::CONCURSO_DE_CONCEPCAO =>  __('Concurso de concep????o'),
            self::ANUNCIO_SIMPLIFICADO =>  __('An??ncio simplificado'),
            self::INSTITUICAO_DE_SISTEMA_DE_QUALIFICACAO =>  __('Institui????o de sistema de qualifica????o'),
            self::INTENCAO_DE_CELEBRACAO_DE_EMPREITADAS_DE_OBRAS_PUBLICAS_POR_CONCESSIONARIOS_QUE_NAO_SEJAM_ENTIDADES_ADJUDICANTES =>  __('Inten????o de celebra????o de empreitadas de obras publicas por concession??rios que n??o sejam entidades adjudicantes'),
            self::PARCERIA_PARA_A_INOVACAO =>  __('Parceria para a inova????o'),
            self::CONCURSO_DE_IDEIAS =>  __('Concurso de ideias'),
            self::INSTITUICAO_DE_SISTEMA_DE_AQUISICAO_DINAMICO =>  __('Institui????o de sistema de aquisi????o din??mico'),
            self::HASTA_PUBLICA_DE_ALIENACAO_DE_BENS_MOVEIS =>  __('Hasta P??blica de Aliena????o de Bens M??veis'),
            self::AQUISICAO_DE_SERVICOS_SOCIAIS_E_DE_OUTROS_SERVICOS_ESPECIFICOS =>  __('Aquisi????o de Servi??os Sociais e de Outros Servi??os Espec??ficos'),
            self::ANUNCIO_DE_ADJUDICACAO_DE_AQUISICAO_DE_SERVICOS_SOCIAIS_E_DE_OUTROS_SERVICOS_ESPECIFICOS =>  __('An??ncio de Adjudica????o de Aquisi????o de Servi??os Sociais e de Outros Servi??os Espec??ficos'),
        ];
    }
    public function getTypeModelOptions()
    {
        return static::getTypeModelArray();
    }
    public function getTypeModelLabelAttribute()
    {
        $array = self::getTypeModelOptions();
        return $array[$this->type_model];
    }

    //TypeContract
    public static function getTypeContractArray()
    {
        return [
            self::TODOS =>  __('Todos'),
            self::AQUISICAO_DE_BENS_MOVEIS =>  __('Aquisi????o de bens m??veis'),
            self::AQUISICAO_DE_SERVICOS =>  __('Aquisi????o de servi??os'),
            self::CONCESSAO_DE_OBRAS_PUBLICAS =>  __('Concess??o de obras p??blicas'),
            self::CONCESSAO_DE_SERVICOS_PUBLICOS =>  __('Concess??o de servi??os p??blicos'),
            self::EMPREITADAS_DE_OBRAS_PUBLICAS =>  __('Empreitadas de obras p??blicas'),
            self::LOCALIZACAO_DE_BENS_MOVEIS =>  __('Localiza????o de bens m??veis'),
            self::TC_SOCIEDADE =>  __('Sociedade'),
            self::TC_OUTROS =>  __('Outros'),
        ];
    }
    public function getTypeContractOptions()
    {
        return static::getTypeContractArray();
    }
    public function getTypeContractLabelAttribute()
    {
        $array = self::getTypeContractOptions();
        return $array[$this->type_contract];
    }

    /**
     * Return the attribute label
     * @param string $attribute
     * @return string
     */
    public static function getAttributeLabel($attribute){
        $attributeLabels = static::attributeLabels();
        return isset($attributeLabels[$attribute]) ? $attributeLabels[$attribute] : __($attribute);
    }

    /**
     * retira da BD o base_id com maior valor
     * @return mixed
     */
    public static function getLastBaseId(){

        return DB::table('contests')->latest()->pluck('base_id')->max();
    }



}
