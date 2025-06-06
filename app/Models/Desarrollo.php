<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desarrollo extends Model
{
    /** @use HasFactory<\Database\Factories\DesarrolloFactory> */
    use HasFactory;

    protected $fillable = [
        'question',
        'answer',
        'question_id',
        'examen_id'
    ];

    public function examen()
    {
        return $this->belongsTo(Examen::class);
    }
}
