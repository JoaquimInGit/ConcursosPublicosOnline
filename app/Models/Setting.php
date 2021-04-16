<?php

namespace App\Models;
use App\Models\Traits\LoadDefaults;
use Cache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\Setting
 *
 * @property int $id
 * @property int $type 1 - textfield | 2 - textarea | 3 - checkbox | 4 - select | 5 - integer | 6 - decimal | 7 - currency | 8 - percentage | 9 - color | 10 - range | 11 - json_array
 * @property string|null $group
 * @property string $name
 * @property string $slug
 * @property string|null $options
 * @property string|null $value
 * @property int $order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed|string $type_label
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereOptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereValue($value)
 * @mixin \Eloquent
 */
class Setting extends Model implements Auditable
{
    use LoadDefaults;
    use \OwenIt\Auditing\Auditable;

    const TYPE_TEXTFIELD = 1;
    const TYPE_TEXTAREA = 2;
    const TYPE_CHECKBOX = 3;
    const TYPE_SELECT = 4;
    const TYPE_INTEGER = 5;
    const TYPE_DECIMAL = 6;
    const TYPE_CURRENCY = 7;
    const TYPE_PERCENTAGE = 8;
    const TYPE_COLOR = 9;
    const TYPE_RANGE = 10;

    /**
     * @var int[] Default values
     */
    /*protected $attributes = [
        'type' => self::TYPE_TEXTFIELD,
        'order' => 0,
    ];*/

    protected $guarded=['id']; // isto permite fazer mass assigment a todas as variáveis pode ser perigoso se não controllar o que passo no request

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::saved(function ($model) {
            Cache::forget('setting-params');
            Cache::forget('setting-options');
        });
    }


    /**
     * Return an array with the values of type field
     * @return array
     */
    public static function getTypeArray()
    {
        return [
            self::TYPE_TEXTFIELD =>  __('Textfield'),
            self::TYPE_TEXTAREA =>  __('Textarea'),
            self::TYPE_CHECKBOX =>  __('Checkbox'),
            self::TYPE_SELECT =>  __('Select'),
            self::TYPE_INTEGER =>  __('Integer'),
            self::TYPE_DECIMAL =>  __('Decimal'),
            self::TYPE_CURRENCY =>  __('Currency'),
            self::TYPE_PERCENTAGE =>  __('Percentage'),
            self::TYPE_COLOR =>  __('Color'),
            self::TYPE_RANGE =>  __('Range'),
        ];
    }

    /**
     * Return an array with the values of type field
     * @return array
     */
    public function getTypeOptions()
    {
        return static::getTypeArray();
    }

    /**
     * Return the first name of the user
     * @return mixed|string
     */
    public function getTypeLabelAttribute()
    {
        $array = self::getTypeOptions();
        return $array[$this->type];
    }

}
