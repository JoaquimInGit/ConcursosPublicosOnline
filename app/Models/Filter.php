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
    const FILTER_OFF = 0;
    const FILTER_ACTIVE_WITH_NOTIFICATIONS = 1;
    const FILTER_ACTIVE_WITHOUT_NOTIFICATIONS = 2;

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
        'type_act' => 'integer',
        'type_model' => 'integer',
        'type_contract' => 'integer',
        'filter_status' => 'integer'
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
        'type_act' => 'required|integer',
        'type_model' => 'required|integer',
        'type_contract' => 'required|integer',
        'filter_status' => 'required|integer',
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
        'entity_id' => __('Entity'),
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

    /**
     * Devolve a entidade atual
     * @return mixed
     */
    public static function getEntity(){
        $entity = Entity::getCurrentEntity();
        return $entity->id;
    }

    //status filter
    public static function getFilterStatusArray()
    {
        return [
            self::FILTER_ACTIVE_WITH_NOTIFICATIONS =>  __('Ativo com Notifica????es'),
            self::FILTER_ACTIVE_WITHOUT_NOTIFICATIONS =>  __('Ativo sem Notifica????es'),
            self::FILTER_OFF=>  __('Desativo'),
        ];
    }
    public function getFilterStatusOptions()
    {
        return static::getFilterStatusArray();
    }
    public function getFilterStatusLabelAttribute()
    {
        $array = self::getFilterStatusOptions();
        return $array[$this->filter_status];
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
     * recebe o valor das description_words e retorna o valor separado por virgulas para ser apresentado nos detalhes de um filtro
     * @return string
     */
    public function getWordsLabelAttribute()
    {
        if(!empty($this->description_words)){
            $keywords = explode(',', $this->description_words);
            $keys = "";
            foreach ($keywords as $word) {
                $aux = explode('"value":"', $word);
                $keys = $keys . $aux[1];
            }
            $keys = str_replace('"}', ' ', $keys);
            $keys = str_replace(']', ' ', $keys);
            $searchValues = preg_split('/\s+/', $keys, -1, PREG_SPLIT_NO_EMPTY);

            return implode(', ',$searchValues);
        }
    }
}
