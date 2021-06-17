<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'entity_id' => $this->faker->word,
        'user_id' => $this->faker->word,
        'name' => $this->faker->word,
        'email' => $this->faker->word,
        'address' => $this->faker->word,
        'zip_code' => $this->faker->word,
        'mobile_phone' => $this->faker->word,
        'nif' => $this->faker->word,
        'coupon' => $this->faker->word,
        'discount' => $this->faker->word,
        'sub_total' => $this->faker->word,
        'iva_value' => $this->faker->word,
        'payment_method' => $this->faker->word,
        'notes' => $this->faker->word,
        'mb_entity' => $this->faker->word,
        'mb_ref' => $this->faker->word,
        'mb_limit_date' => $this->faker->word,
        'mbway_ref' => $this->faker->word,
        'mbway_alias' => $this->faker->word,
        'payment_ref' => $this->faker->word,
        'invoice_id' => $this->faker->word,
        'invoice_link' => $this->faker->word,
        'payment_limit_date' => $this->faker->word,
        'invoice_status' => $this->faker->word,
        'status' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
