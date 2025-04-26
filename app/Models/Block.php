<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    protected $fillable = [
        'examen_id',
        'question_id',
        'question',
        'option_0',
        'option_1',
        'option_2',
        'option_3',
        'option_4',
    ];

    public function examen()
    {
        return $this->belongsTo(Examen::class);
    }
}
