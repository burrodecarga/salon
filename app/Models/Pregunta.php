<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    /** @use HasFactory<\Database\Factories\PreguntaFactory> */
    use HasFactory;

    protected $fillable = [
        'examen_id',
        'asignatura_id',
        'teacher_id',
        'question_id',
        'option_id',
        'question',
        'answer',
        'is_true'
    ];

    public function examen()
    {
        return $this->belonsTo(Examen::class);
    }
}
