<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Lesson;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $p="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus temporibus delectus, autem ut molestiae laboriosam, tempora totam architecto iure dignissimos a, dolore perspiciatis dolor asperiores ipsa fugit nesciunt minus aliquam!";
        return [
            'question' => $this->faker->sentence(3),
            'answer' => $p,
            'lesson_id' => Lesson::factory() //
        ];
    }
}
