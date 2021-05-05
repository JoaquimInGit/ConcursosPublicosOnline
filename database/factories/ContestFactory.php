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
            'num_announcement' => $this->faker->word,
        'description' => $this->faker->text,
        'entity' => $this->faker->word,
        'type_act' => $this->faker->word,
        'type_model' => $this->faker->word,
        'type_contract' => $this->faker->word,
        'price' => $this->faker->word,
        'publication_date' => $this->faker->word,
        'deadline' => $this->faker->word,
        'state' => $this->faker->word,
        'republic_diary' => $this->faker->word,
        'cpv' => $this->faker->word,
        'cpv_description' => $this->faker->text,
        'procedure_parts' => $this->faker->word,
        'pdf_content' => $this->faker->text,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
