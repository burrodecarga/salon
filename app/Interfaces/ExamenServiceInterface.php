<?php

namespace App\Interfaces;

use App\Models\Asignatura;
use App\Models\Teacher;

interface ExamenServiceInterface
{
    public function prueba();
    public function get_preguntas_por_examen($examen_id);
    public function preguntas_por_asignatura($asignatura_id, $teacher_id);
    public function get_preguntas_por_block($asignatura_id, $teacher_id);
}
