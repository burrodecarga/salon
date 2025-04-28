<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    /** @use HasFactory<\Database\Factories\QuestionFactory> */
    use HasFactory;

    protected $fillable = [
        'question',
        'correct',
        'explain',
        'level',
        'type',
        'explain',
        'lesson_id',
        'modulo_id',
        'asignatura_id',
        'lesson',
        'modulo',
        'asignatura',
    ];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }


    public function options()
    {
        return $this->hasMany(Option::class);
    }

    public function examens()
    {
        return $this->belongsToMany(Examen::class)->withTimestamps();
    }
}
