<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Question;
use App\Models\Option;
use App\Models\Modulo;
use App\Models\Lesson;
use App\Models\Asignatura;

class AsignaturaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Asignatura::factory()->count(5)->has(Modulo::factory()->count(6)->has(Lesson::factory()->count(10)->has(Question::factory()->count(10)->has(Option::factory()->count(5)))))->create();//
    }
}
