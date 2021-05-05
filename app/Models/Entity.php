<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\LoadDefaults;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class Entity
 * @package App\Models
 * @version May 4, 2021, 11:42 pm UTC
 *
 * @property \App\Models\User $user
 * @property integer $user_id
 * @property string $designation
 * @property string $country
 * @property string $district
 * @property string $address
 * @property string $postal_code
 * @property string $mobile_phone
 * @property string $nif
 * @property string $cae
 * @property string $cae_secundario
 * @property string $website
 * @property string $email_entity
 * @property integer $state
 */
class Entity extends Model implements Auditable
{
    use LoadDefaults;
    use \OwenIt\Auditing\Auditable;

    public $table = 'entities';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';




    public $fillable = [
        'user_id',
        'designation',
        'country',
        'district',
        'address',
        'postal_code',
        'mobile_phone',
        'nif',
        'cae',
        'cae_secundario',
        'website',
        'email_entity',
        'state'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'designation' => 'string',
        'country' => 'string',
        'district' => 'string',
        'address' => 'string',
        'postal_code' => 'string',
        'mobile_phone' => 'string',
        'nif' => 'string',
        'cae' => 'string',
        'cae_secundario' => 'string',
        'website' => 'string',
        'email_entity' => 'string',
        'state' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required',
        'designation' => 'required|string|max:255',
        'country' => 'required|string|max:255',
        'district' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'postal_code' => 'required|string|max:255',
        'mobile_phone' => 'required|string|max:255',
        'nif' => 'required|string|max:255',
        'cae' => 'nullable|string|max:255',
        'cae_secundario' => 'nullable|string|max:255',
        'website' => 'nullable|string|max:255',
        'email_entity' => 'nullable|string|max:255',
        'state' => 'required',
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
        'user_id' => __('User Id'),
        'designation' => __('Designation'),
        'country' => __('Country'),
        'district' => __('District'),
        'address' => __('Address'),
        'postal_code' => __('Postal Code'),
        'mobile_phone' => __('Mobile Phone'),
        'nif' => __('Nif'),
        'cae' => __('Cae'),
        'cae_secundario' => __('Cae Secundario'),
        'website' => __('Website'),
        'email_entity' => __('Email Entity'),
        'state' => __('State'),
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
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
