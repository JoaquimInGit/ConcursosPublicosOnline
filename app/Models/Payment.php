<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\LoadDefaults;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class Payment
 * @package App\Models
 * @version August 4, 2020, 9:37 am UTC
 *
 * @property \App\Models\Order $order
 * @property integer $order_id
 * @property number $value
 * @property string $currency
 * @property integer $payment_method
 * @property string $transaction_id
 * @property string $raw_data
 * @property integer $status
 */
class Payment extends Model implements Auditable
{
    use LoadDefaults;
    use \OwenIt\Auditing\Auditable;

    public $table = 'payments';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    const PAYMENT_METHOD_UNKNOWN = 0;
    const PAYMENT_METHOD_MB_REF = 1;
    const PAYMENT_METHOD_MBWAY = 2;
    const PAYMENT_METHOD_DIRECT_DEBIT = 3;
    const PAYMENT_METHOD_WIRE_TRANSFER = 4;
    const PAYMENT_METHOD_MONEY = 5;

    const STATUS_PAYMENT_COMPLETED = 1;
    const STATUS_PAYMENT_FAILED = 2;

    public $fillable = [
        'order_id',
        'value',
        'currency',
        'payment_method',
        'transaction_id',
        'raw_data',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'order_id' => 'integer',
        'value' => 'decimal:2',
        'currency' => 'string',
        'payment_method' => 'integer',
        'transaction_id' => 'string',
        'raw_data' => 'string',
        'status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'order_id' => 'required',
        'value' => 'required|numeric',
        'currency' => 'required|string|max:3',
        'payment_method' => 'required',
        'transaction_id' => 'nullable|string|max:64',
        'raw_data' => 'nullable|string',
        'status' => 'required',
        //'created_at' => 'nullable',
        //'updated_at' => 'nullable'
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
            'order_id' => __('Order Id'),
            'value' => __('Value'),
            'currency' => __('Currency'),
            'payment_method' => __('Payment method'),
            'transaction_id' => __('Transaction Id'),
            'raw_data' => __('Raw Data'),
            'status' => __('Status'),
            'created_at' => __('Created at'),
            'updated_at' => __('Updated at')
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
    public function order()
    {
        return $this->belongsTo(\App\Models\Order::class, 'order_id');
    }

    /**
     * Return an array with the values of payment_method  field
     * @return array
     */
    public static function getPaymentMethodArray()
    {
        return [
            self::PAYMENT_METHOD_UNKNOWN =>  __('Unknown'),
            self::PAYMENT_METHOD_MB_REF =>  __('MB Reference'),
            self::PAYMENT_METHOD_MBWAY =>  __('MBWay'),
            self::PAYMENT_METHOD_DIRECT_DEBIT =>  __('Direct debit'),
            self::PAYMENT_METHOD_WIRE_TRANSFER =>  __('Wire transfer'),
            self::PAYMENT_METHOD_MONEY =>  __('Money'),
        ];
    }

    /**
     * Return an array with the values of payment_method field
     * @return array
     */
    public function getPaymentMethodOptions()
    {
        return static::getPaymentMethodArray();
    }

    /**
     * Return the PaymentMethod selected
     * @return mixed|string
     */
    public function getPaymentMethodLabelAttribute()
    {
        $array = self::getPaymentMethodOptions();
        return $array[$this->payment_method];
    }

    /**
     * Return an array with the values of status field
     * @return array
     */
    public static function getStatusArray()
    {
        return [
            self::STATUS_PAYMENT_COMPLETED =>  __('Payment completed'),
            self::STATUS_PAYMENT_FAILED =>  __('Payment failed'),
        ];
    }

    /**
     * Return an array with the values of status field
     * @return array
     */
    public function getStatusOptions()
    {
        return static::getStatusArray();
    }

    /**
     * Return the status selected
     * @return mixed|string
     */
    public function getStatusLabelAttribute()
    {
        $array = self::getStatusOptions();
        return $array[$this->status];
    }

    /**
     * Set the payment method based on eupago method returned
     * @param $method
     */
    public function setEupagoPaymentMethod($method){
        switch ($method){
            case "PC:PT":
                $this->payment_method = self::PAYMENT_METHOD_MB_REF;
                break;
            case "MW:PT":
                $this->payment_method = self::PAYMENT_METHOD_MBWAY;
                break;
            case "DD:PT":
            case "DB:PT":
                $this->payment_method = self::PAYMENT_METHOD_DIRECT_DEBIT;
                break;
            default:
                $this->payment_method = self::PAYMENT_METHOD_UNKNOWN;
        }
    }
}