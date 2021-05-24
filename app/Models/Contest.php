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
    public static function getAttributeLabel($attribute){
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
            self::ANUNCIO_PROCEDIMENTO =>  __('Anúncio de procedimento'),
            self::ANUNCIO_CONCURSO_URGENTE =>  __('Anúncio de concurso urgente'),
            self::DECLARACAO_RETIFICACAO_ANUNCIO =>  __('Declaração de retificação de anúncio'),
            self::AVISO_PRORROCACAO_PRAZO =>  __('Aviso de prorrogação de prazo'),
        ];
    }
    public function getTypeActOptions()
    {
        return static::getTypeActArray();
    }
    public function getTypeActLabelAttribute()
    {
        $array = self::getTypeActOptions();
        return $array[$this->status];
    }

    //TypeModel
    public static function getTypeModelArray()
    {
        return [
            self::TODOS =>  __('Todos'),
            self::CONCURSO_PUBLICO =>  __('Concurso público'),
            self::CONCURSOS_PUBLICO_URGENTE =>  __('Concurso público urgente'),
            self::CONCURSOS_LIMITADO_POR_PREVIA_QUALIFICACAO =>  __('Concurso limitado por prévia qualificação'),
            self::PROCEDIMENTO_DE_NEGOCIACAO =>  __('Procedimento de negociação'),
            self::DIALOGO_CONCORRENCIAL =>  __('Diálogo concorrencial'),
            self::CONCURSO_DE_CONCEPCAO =>  __('Concurso de concepção'),
            self::ANUNCIO_SIMPLIFICADO =>  __('Anúncio simplificado'),
            self::INSTITUICAO_DE_SISTEMA_DE_QUALIFICACAO =>  __('Instituição de sistema de qualificação'),
            self::INTENCAO_DE_CELEBRACAO_DE_EMPREITADAS_DE_OBRAS_PUBLICAS_POR_CONCESSIONARIOS_QUE_NAO_SEJAM_ENTIDADES_ADJUDICANTES =>  __('Intenção de celebração de empreitadas de obras publicas por concessionários que não sejam entidades adjudicantes'),
            self::PARCERIA_PARA_A_INOVACAO =>  __('Parceria para a inovação'),
            self::CONCURSO_DE_IDEIAS =>  __('Concurso de ideias'),
            self::INSTITUICAO_DE_SISTEMA_DE_AQUISICAO_DINAMICO =>  __('Instituição de sistema de aquisição dinâmico'),
            self::HASTA_PUBLICA_DE_ALIENACAO_DE_BENS_MOVEIS =>  __('Hasta Pública de Alienação de Bens Móveis'),
            self::AQUISICAO_DE_SERVICOS_SOCIAIS_E_DE_OUTROS_SERVICOS_ESPECIFICOS =>  __('Aquisição de Serviços Sociais e de Outros Serviços Específicos'),
            self::ANUNCIO_DE_ADJUDICACAO_DE_AQUISICAO_DE_SERVICOS_SOCIAIS_E_DE_OUTROS_SERVICOS_ESPECIFICOS =>  __('Anúncio de Adjudicação de Aquisição de Serviços Sociais e de Outros Serviços Específicos'),
        ];
    }
    public function getTypeModelOptions()
    {
        return static::getTypeModelArray();
    }
    public function getTypeModelLabelAttribute()
    {
        $array = self::getTypeModelOptions();
        return $array[$this->status];
    }

    //TypeContract
    public static function getTypeContractArray()
    {
        return [
            self::TODOS =>  __('Todos'),
            self::AQUISICAO_DE_BENS_MOVEIS =>  __('Aquisição de bens móveis'),
            self::AQUISICAO_DE_SERVICOS =>  __('Aquisição de serviços'),
            self::CONCESSAO_DE_OBRAS_PUBLICAS =>  __('Concessão de obras públicas'),
            self::CONCESSAO_DE_SERVICOS_PUBLICOS =>  __('Concessão de serviços públicos'),
            self::EMPREITADAS_DE_OBRAS_PUBLICAS =>  __('Empreitadas de obras públicas'),
            self::LOCALIZACAO_DE_BENS_MOVEIS =>  __('Localização de bens móveis'),
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
        return $array[$this->status];
    }
}
