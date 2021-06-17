<?php

namespace Database\Factories;

use App\Models\ContestFilter;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContestFilterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ContestFilter::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'contest_id' => $this->faker->word,
        'filter_id' => $this->faker->word,
        'date' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
