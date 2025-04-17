<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    /** @use HasFactory<\Database\Factories\AulaFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'periodo',
        'slug',
        'asignatura',
        'asignatura_id',
        'teacher_id',
        'teacher',
        'inicio',
        'fin',
        'status'
    ];


    protected $dates = [
        'created_at',
        'updated_at',

        // your other new column
    ];

    protected $casts = [
        'inicio' => 'datetime:d-m-Y',
        'fin' => 'datetime:d-m-Y',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class)->withTimestamps();
    }
}
