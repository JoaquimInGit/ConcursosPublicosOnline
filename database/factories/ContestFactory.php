<?php

namespace Database\Factories;

use App\Models\Contest;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contest::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'base_id' => $this->faker->randomDigitNotNull,
        'num_announcement' => $this->faker->word,
        'description' => $this->faker->text,
        'entity' => $this->faker->word,
        'price' => $this->faker->word,
        'publication_date' => $this->faker->word,
        'deadline_date' => $this->faker->word,
        'proposal_time_limit' => $this->faker->word,
        'republic_diary_num' => $this->faker->randomDigitNotNull,
        'republic_diary_serie' => $this->faker->randomDigitNotNull,
        'cpv' => $this->faker->word,
        'cpv_description' => $this->faker->text,
        'procedure_parts' => $this->faker->word,
        'link_announcement' => $this->faker->word,
        'pdf_content' => $this->faker->text,
        'type_act' => $this->faker->word,
        'type_model' => $this->faker->word,
        'type_contract' => $this->faker->word,
        'status' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
