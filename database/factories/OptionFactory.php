<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Question;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Option>
 */
class OptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $p="Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ad placeat ab incidunt mollitia repellendus tenetur earum expedita, aliquam dolorem, unde amet possimus accusantium magnam obcaecati libero dolorum nostrum dignissimos ducimus similique, cum culpa at quisquam esse laborum! Doloremque consequuntur dolores modi eum, omnis obcaecati magni aperiam rem reprehenderit aliquid ex neque, autem facere? Vel, laboriosam consequatur. Corrupti repellat ratione, harum possimus voluptatibus et quam illum consectetur alias rerum quos quaerat.";
        return [
            'is_true' => $this->faker->boolean(0.2),
            'answer' => $p,
            'question_id' => Question::factory()
        ];
    }
}
