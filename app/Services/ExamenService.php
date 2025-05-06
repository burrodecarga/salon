<?php

namespace App\Services;

use App\Interfaces\ExamenServiceInterface;
use App\Models\Examen;
use App\Models\Nota;
use App\Models\Pregunta;
use App\Models\Prototipo;
use PhpParser\JsonDecoder;





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

    function set_examen($examen_id, $student_id, $preguntas, $respuestas)
    {

        $nota = Nota::create([
            'examen_id' => $examen_id,
            'student_id' => $student_id,
            'preguntas' => json_encode($preguntas),
            'respuestas' => "json_encode($respuestas)"
        ]);

        return response()->json(['a' => $student_id, 'b' => $examen_id, $preguntas, 'd' => $respuestas]);

    }

    function parametro($a, $b, $c, $d)
    {
        $nota = Nota::create(
            [
                'examen_id' => $c,
                'student_id' => $d,
                'preguntas' => json_encode($a),
                'respuestas' => json_encode($b),
            ]
        );

        return response()->json(['a' => $a, 'b' => gettype($b)]);
    }

}


