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
        return $this->belongsTo(User::class, 'teacher_id');
    }
    public function students()
    {
        return $this->belongsToMany(User::class, 'asignatura_student', 'asignatura_id', 'student_id');
    }


}
