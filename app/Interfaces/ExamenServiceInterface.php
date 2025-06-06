<?php

namespace App\Interfaces;

use App\Models\Asignatura;
use App\Models\Teacher;

interface ExamenServiceInterface
{
    public function prueba();
    public function get_preguntas_por_examen($examen_id);
    public function get_preguntas_por_asignatura($asignatura_id, $teacher_id);
    public function get_preguntas_por_block($asignatura_id, $teacher_id);
    public function get_preguntas_level_type();
    public function set_examen($student_id, $teacher_id, $preguntas, $respuestas);
    public function parametro($a, $b, $c, $d);
}
