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
        'option_id',
        'true',
        'selected',
        'question',
        'answer',
        'option_0',
        'option_1',
        'option_2',
        'option_3',
        'option_4',
        'option_0_value',
        'option_1_value',
        'option_2_value',
        'option_3_value',
        'option_4_value',
    ];


    public function examen()
    {
        return $this->belongsTo(Examen::class);
    }
}
