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
        $p = "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus temporibus delectus, autem ut molestiae laboriosam, tempora totam architecto iure dignissimos a, dolore perspiciatis dolor asperiores ipsa fugit nesciunt minus aliquam!";
        $lesson = Lesson::inRandomOrder()->first();
        $modulo = $lesson->modulo;
        $asignatura = $modulo->asignatura;
        return [
            'question' => $this->faker->text(200),
            'level' => $this->faker->randomElement(['dificultad baja', 'dificultad baja-media', 'dificultad media', 'dificultad media-baja', 'dificultad alta']),
            'type' => $this->faker->randomElement(['simple', 'multiple', 'multiple', 'multiple', 'multiple']),
            'lesson_id' => $lesson->id,
            'modulo_id' => $modulo->id,
            'asignatura_id' => $asignatura->id,
            'lesson' => $lesson->name,
            'modulo' => $modulo->name,
            'asignatura' => $asignatura->name,
            //
        ];
    }
}
