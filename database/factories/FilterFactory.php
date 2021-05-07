<?php

namespace Database\Factories;

use App\Models\Filter;
use Illuminate\Database\Eloquent\Factories\Factory;

class FilterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Filter::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'entity_id' => $this->faker->word,
        'filter_name' => $this->faker->word,
        'filter_status' => $this->faker->word,
        'description_words' => $this->faker->word,
        'contest_entity' => $this->faker->word,
        'type_act' => $this->faker->word,
        'type_model' => $this->faker->word,
        'type_contract' => $this->faker->word,
        'min_price' => $this->faker->word,
        'max_price' => $this->faker->word,
        'cpv' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
