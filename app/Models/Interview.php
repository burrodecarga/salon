<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    /** @use HasFactory<\Database\Factories\InterviewFactory> */
    use HasFactory;

    protected $fillable = [
        'fecha',
        'nota',
        'status',
        'aula_id',
        'teacher',
        'student',
        'teacher_id',
        'student_id',
    ];
}
