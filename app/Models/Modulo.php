<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    /** @use HasFactory<\Database\Factories\ModuloFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'asignatura_id'
    ];


    public function asignatura()
    {
        return $this->belongsTo(Asignatura::class);
    }
    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }


}
