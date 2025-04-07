<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Multiple extends Model
{
    /** @use HasFactory<\Database\Factories\MultipleFactory> */
    use HasFactory;

    protected $fillable = [
        'is_true',
        'opcion',
        'examen_id',
    ];



    public function examen()
    {
        return $this->belongsTo(Examen::class);
    }
}
