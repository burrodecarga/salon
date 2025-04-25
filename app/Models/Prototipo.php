<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prototipo extends Model
{
    /** @use HasFactory<\Database\Factories\PrototipoFactory> */
    use HasFactory;

    protected $fillable = [
        'examen_id',
        'asignatura_id',
        'teacher_id',
        'question_id',
        'question',
        'answer',
        'option_1',
        'option_2',
        'option_3',
        'option_4',
        'option_5',
    ];
}
