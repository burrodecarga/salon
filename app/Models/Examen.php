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
        'asignatura_id',
        'modulo_id',
        'lesson_id',
        'user_id',
    ];
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }


    public function seleccions()
    {
        return $this->hasMany(Seleccion::class);
    }

    public function questios()
    {
        return $this->belongsToMany(Question::class)->withTimestamps();
    }

    public function profesor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


}
