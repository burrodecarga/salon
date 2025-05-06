<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    /** @use HasFactory<\Database\Factories\NotaFactory> */
    use HasFactory;

    protected $fillable = [
        'student_id',
        'examen_id',
        'preguntas',
        'respuestas'
    ];
}
