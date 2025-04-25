<?php

namespace App\Models;

use App\Models\Scopes\TeacherScope;




class Teacher extends User
{
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new TeacherScope);
    }

    protected $table = 'users';

    public function asignaturas()
    {
        return $this->hasMany(Asignatura::class, 'teacher_id');
    }

    public function examens()
    {
        return $this->hasMany(Examen::class, 'teacher_id');
    }

    public function aulas()
    {
        return $this->hasMany(Aula::class, 'teacher_id');
    }


}
