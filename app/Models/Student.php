<?php

namespace App\Models;

use App\Models\Scopes\StudentScope;






class Student extends User
{
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new StudentScope);
    }

    protected $table = 'users';

    public function asignaturas()
    {
        return $this->belongsToMany(Asignatura::class, 'asignatura_student', 'asignatura_id', 'student_id');
    }
}
