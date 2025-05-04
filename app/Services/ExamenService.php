<?php

namespace App\Services;

use App\Interfaces\ExamenServiceInterface;
use App\Models\Examen;
use App\Models\Pregunta;
use App\Models\Prototipo;





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
        // //$questions = $examen->questions()->inRandomOrder()->get();

        // foreach ($questions as $question) {
        //     foreach ($question->options as $option) {
        //         Pregunta::updateOrCreate([
        //             'examen_id' => $examen->id,
        //             'asignatura_id' => $examen->asignatura_id,
        //             'teacher_id' => $examen->teacher_id,
        //             'question_id' => $option->question_id,
        //             'option_id' => $option->id,
        //         ], [
        //             'question' => $option->question,
        //             'answer' => $option->answer,
        //         ]);
        //     }
        // }

        //$questions = Pregunta::where('examen_id', $examen_id)->get();

        //return $examen;
    }

    public function get_preguntas_por_asignatura($asignatura_id, $teacher_id)
    {
        $examen = Examen::where('asignatura_id', $asignatura_id)
            ->where('teacher_id', $teacher_id)->where('activo', '1')->first();
        //return $examen;
        if ($examen) {

            $preguntas = Pregunta::where('examen_id', $examen->id)->get();
            //$preguntas = $examen->questions;
            return $preguntas;
        } else {
            return response()->json([
                "message" => "registro no encontrado",
                "status" => 404
            ], 404);
        }
    }

    public function get_preguntas_por_block($asignatura_id, $teacher_id)
    {

        $examen = Examen::where('asignatura_id', $asignatura_id)
            ->where('teacher_id', $teacher_id)->where('activo', '1')->get()->first();

        //return response()->json(["a" => $asignatura_id, "b" => $teacher_id,'examen'=>$examen]);

        if ($examen) {
            $preguntas = $examen->prototipos->take(30);

            return $preguntas;
        } else {
            return response()->json([
                "message" => "registro no encontrado",
                "status" => 404
            ], 404);
        }
    }


    public function get_preguntas_level_type()
    {
        $select = "    SELECT
    `questions`.*
    , `options`.*
    , `questions`.`level`
    , `questions`.`type`
FROM
    `salon`.`options`
    INNER JOIN `salon`.`questions`
        ON (`options`.`question_id` = `questions`.`id`)
WHERE (`questions`.`level` ='dificultad media'
    AND `questions`.`type` ='multiple');";
    }

    function set_examen($student_id, $teacher_id, $preguntas, $respuestas)
    {

    }

}


