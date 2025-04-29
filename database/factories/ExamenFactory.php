<?php

namespace Database\Factories;

use App\Models\Lesson;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Examen>
 */
class ExamenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $lesson = Lesson::inRandomOrder()->first();
        $modulo = $lesson->modulo;
        $asignatura = $modulo->asignatura;
        return [
            'name' => 'parcial de ' . $lesson->name,
            'description' => 'descripcion',
            'type' => 'selección múltiple',
            'level' => 'dificultad media',
            'asignatura' => $asignatura->name,
            'modulo' => $modulo->name,
            'lesson' => $lesson->name,
            // 'aula_id' => 1,
            'asignatura_id' => $asignatura->id,
            'modulo_id' => $modulo->id,
            'lesson_id' => $lesson->id,
            'teacher_id' => $asignatura->teacher_id,
            'activo' => 1
        ];
    }
}
