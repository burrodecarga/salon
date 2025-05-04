<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Teacher;
use App\Models\Aula;
use App\Models\Asignatura;

class AulaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $profesor = Teacher::find(11);
        //$asignaturas = Asignatura::all();
        //var_dump($profesor->id, $asignaturas);
        $asignaturas = Asignatura::where('teacher_id', '11')->get();
        foreach ($asignaturas as $key => $asignatura) {
            $name = 'sección ' . $key . ' ' . $asignatura->name;
            var_dump($name);
            Aula::create([
                'name' => $name,
                'periodo' => date(now()),
                'slug' => Str::slug($name),
                'asignatura' => $asignatura->name,
                'asignatura_id' => $asignatura->id,
                'teacher_id' => $profesor->id,
                'teacher' => $profesor->name,
                'inicio' => date(now()),
                'fin' => date(now()),
                'status' => 1
            ]);
        }
    }
}
