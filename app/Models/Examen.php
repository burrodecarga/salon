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
        'lesson_id',
    ];
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function multiples()
    {
        return $this->hasMany(Multiple::class);
    }

    public function seleccions()
    {
        return $this->hasMany(Seleccion::class);
    }

    public function desarrollos()
    {
        return $this->hasMany(Desarrollo::class);
    }
}
