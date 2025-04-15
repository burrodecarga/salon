<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Question;
use App\Models\Option;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $preguntas = Question::all();

        foreach ($preguntas as $key => $pregunta) {
            if ($pregunta->type == 'simple') {

                $is_true = rand(0, 1);

                Option::create([
                    'is_true' => $is_true,
                    'answer' => $is_true ? ' Respuesta Correcta marcada como true' : 'respuesta falsa',
                    'question_id' => $pregunta->id

                ]);
                Option::create([
                    'is_true' => !$is_true,
                    'answer' => !$is_true ? ' Respuesta Correcta marcada como true' : 'respuesta falsa o incorrecta',
                    'question_id' => $pregunta->id

                ]);


            } else {
                for ($i = 1; $i <= 4; $i++) {

                    $k = rand(1, 4);
                    Option::create([
                        'is_true' => $k == $i ? 1 : 0,
                        'answer' => $k == $i ? ' Opción Correcta marcada como true' : 'Opción incorrecta o falsa',
                        'question_id' => $pregunta->id

                    ]);
                }

            }
        }
    }
}
