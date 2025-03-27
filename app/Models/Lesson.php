<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    /** @use HasFactory<\Database\Factories\LessonFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'video',
        'modulo_id'
    ];

    public function modulo()
    {
        return $this->belongsTo(Modulo::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
