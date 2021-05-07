<?php

namespace Database\Factories;

use App\Models\Entity;
use Illuminate\Database\Eloquent\Factories\Factory;

class EntityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Entity::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->word,
        'designation' => $this->faker->word,
        'country' => $this->faker->word,
        'district' => $this->faker->word,
        'address' => $this->faker->word,
        'postal_code' => $this->faker->word,
        'mobile_phone' => $this->faker->word,
        'nif' => $this->faker->word,
        'cae' => $this->faker->word,
        'cae_secundario' => $this->faker->word,
        'website' => $this->faker->word,
        'email_entity' => $this->faker->word,
        'status' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
