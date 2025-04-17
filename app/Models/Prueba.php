<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prueba extends Model
{
    /** @use HasFactory<\Database\Factories\PruebaFactory> */
    use HasFactory;

    protected $fillable =[
    'fecha',
    'correct_answers',
    'student_answers',
    'student_correct',
    'questions',
    'correct',
    'base',
    'nota',
    'examen_id',
    'teacher_id',
    'student_id',];

    protected $dates = [
        'created_at',
        'updated_at',

        // your other new column
    ];

    protected $casts = [
        'fecha' => 'datetime:d-m-Y',
    ];


    public function examen(){
        return $this->belongsTo(Examen::class);
    }
}


