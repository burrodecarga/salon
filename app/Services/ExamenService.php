<?php

namespace App\Services;

use App\Interfaces\ExamenServiceInterface;
use App\Models\Examen;
use App\Models\Pregunta;





class ExamenService implements ExamenServiceInterface
{
    public function prueba()
    {
        return 'Funcionando OK';
    }

    public function get_preguntas_por_examen($examen_id)
    {
        $examen = Examen::find($examen_id);
        return $examen;
        $questions = $examen->questions()->inRandomOrder()->get();

        foreach ($questions as $question) {
            foreach ($question->options as $option) {
                Pregunta::updateOrCreate([
                    'examen_id' => $examen->id,
                    'asignatura_id' => $examen->asignatura_id,
                    'teacher_id' => $examen->teacher_id,
                    'question_id' => $option->question_id,
                    'option_id' => $option->id,
                ], [
                    'question' => $option->question,
                    'answer' => $option->answer,
                ]);
            }
        }

        $questions = Pregunta::where('examen_id', $examen_id)->get();

        return $questions;
    }

    public function preguntas_por_asignatura($asignatura_id, $teacher_id)
    {
        $examen = Examen::where('asignatura_id', $asignatura_id)
            ->where('teacher_id', $teacher_id)->where('activo', '1')->get()->first();
        $preguntas = Pregunta::where('examen_id', $examen->id)->get();

        return $preguntas;
    }

    public function preguntas_por_block($asignatura_id, $teacher_id)
    {
        $examen = Examen::where('asignatura_id', $asignatura_id)
            ->where('teacher_id', $teacher_id)->where('activo', '1')->get()->first();
        $preguntas = $examen->prototipos;

        return $preguntas;
    }
}
