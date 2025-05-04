<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
    /** @use HasFactory<\Database\Factories\AsignaturaFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'teacher_id'
    ];


    public function modulos()
    {
        return $this->hasMany(Modulo::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
    public function students()
    {
        return $this->belongsToMany(User::class, 'asignatura_student', 'asignatura_id', 'student_id');
    }

    public function examens()
    {
        return $this->hasMany(Examen::class);
    }

    public function lessons()
    {
        return $this->hasManyThrough(Lesson::class, Modulo::class);
    }

    public function examenes_via_teacher()
    {
        return $this->hasManyThrough(Examen::class, Teacher::class, 'id', 'teacher_id');
    }

    public function examenes_via_asignatura()
    {
        return $this->hasManyThrough(Examen::class, Asignatura::class, 'id', 'asignatura_id');
    }



}
