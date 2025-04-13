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
        'user_id'
    ];

    public function profesor(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function modulos()
    {
        return $this->hasMany(Modulo::class);
    }
}
