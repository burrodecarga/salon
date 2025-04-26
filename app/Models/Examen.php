<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{
    /** @use HasFactory<\Database\Factories\ExamenFactory> */
    use HasFactory;

    protected $fillable = [

        'name',
        'description',
        'type',
        'level',
        'asignatura',
        'modulo',
        'lesson',
        'aula_id',
        'asignatura_id',
        'modulo_id',
        'lesson_id',
        'teacher_id',
        'activo'
    ];
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }



    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
    public function questions()
    {
        return $this->belongsToMany(Question::class)->withTimestamps();
    }

    public function block()
    {
        return $this->hasOne(Block::class);
    }

    public function pruebas()
    {
        return $this->hasMany(Prueba::class);
    }

    public function preguntas()
    {
        return $this->hasMany(Pregunta::class);
    }

    public function pruototipos()
    {
        return $this->hasMany(Prototipo::class);
    }






}
