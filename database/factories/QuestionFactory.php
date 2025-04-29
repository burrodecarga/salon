<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Lesson;
use App\Models\Examen;

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
        // $po = "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus temporibus delectus, autem ut molestiae laboriosam, tempora totam architecto iure dignissimos a, dolore perspiciatis dolor asperiores ipsa fugit nesciunt minus aliquam!";
        $lesson = Lesson::inRandomOrder()->first();
        $modulo = $lesson->modulo;
        $asignatura = $modulo->asignatura;
        $examen = Examen::inRandomOrder()->first();
        // $examen = Examen::create([
        //     'name' => 'parcial de prueba',
        //     'description' => 'descripcion',
        //     'type' => 'selección múltiple',
        //     'level' => 'dificultad media',
        //     'asignatura' => $asignatura->name,
        //     'modulo' => $modulo->name,
        //     'lesson' => $lesson->name,
        //     // 'aula_id' => 1,
        //     'asignatura_id' => $asignatura->id,
        //     'modulo_id' => $modulo->id,
        //     'lesson_id' => $lesson->id,
        //     'teacher_id' => $asignatura->teacher_id,
        //     'activo' => 1
        // ]);

        return [
            'question' => $this->faker->text(200),
            'correct' => $this->faker->text(100),
            'explain' => $this->faker->text(200),
            'level' => $this->faker->randomElement(['dificultad baja', 'dificultad baja-media', 'dificultad media', 'dificultad media-baja', 'dificultad alta']),
            'type' => $this->faker->randomElement(['simple', 'multiple', 'multiple', 'multiple', 'multiple']),
            'lesson_id' => $lesson->id,
            'modulo_id' => $modulo->id,
            'asignatura_id' => $asignatura->id,
            'lesson' => $lesson->name,
            'modulo' => $modulo->name,
            'asignatura' => $asignatura->name,
            'examen_id' => $examen->id
        ];
    }
}
