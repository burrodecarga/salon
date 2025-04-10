<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    /** @use HasFactory<\Database\Factories\QuestionFactory> */
    use HasFactory;

    protected $fillable = [
        'question',
        'level',
        'type',
        'lesson_id'
    ];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }


    public function options()
    {
        return $this->hasMany(Option::class);
    }
}
