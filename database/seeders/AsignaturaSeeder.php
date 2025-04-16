<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
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

        $materias = [
            'anatomía',
            'biología',
            'química',
            'fisiología',
            'microbiología',
            'farmacología',
            'patología',
            'neurología'
        ];

        $p = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur, est architecto ea vitae quam quis fugiat excepturi eum eaque deleniti voluptates eveniet ut animi nam repudiandae nemo inventore? Dolore ab amet suscipit autem, quam aperiam velit! Voluptas vero eveniet, expedita saepe sunt quae, distinctio veniam quo sapiente illum ullam quidem nesciunt architecto repudiandae eum, ratione harum ut laudantium inventore exercitationem esse iste! Vel iste numquam totam libero quos natus suscipit, enim amet repellat ad voluptatibus exercitationem dolorem provident odio a officia minima! Aspernatur autem corrupti, dolor explicabo accusamus libero quibusdam commodi distinctio rerum recusandae repellendus error exercitationem deserunt atque culpa animi. Repellat provident excepturi reiciendis maxime ipsa voluptas id perferendis magni omnis obcaecati cum labore non iusto vero perspiciatis nesciunt ea nemo, esse amet autem atque recusandae! Labore, quibusdam veritatis. Quod incidunt, reprehenderit minus, quaerat, dolores labore optio ratione corporis totam velit necessitatibus perspiciatis quisquam architecto. Tempora voluptatibus nostrum placeat. Obcaecati perferendis ipsum vitae, eaque quisquam rem quod fugiat enim eveniet praesentium atque quia, est mollitia impedit officia placeat reprehenderit iure et eligendi? Eius, dicta. Placeat molestias in architecto ut consequuntur laboriosam nulla ad? Nostrum quaerat excepturi veniam accusantium fugiat perferendis corrupti minus beatae soluta quasi dolores ea doloribus temporibus, veritatis eos eum eaque ipsam necessitatibus obcaecati ad earum incidunt harum hic consequatur! Suscipit minima laboriosam et libero, labore assumenda. Eum, modi accusamus. Rem, dignissimos consequuntur error culpa tempora cupiditate porro eligendi itaque excepturi, sint rerum provident eum, doloremque mollitia cumque vel quod molestias dolore suscipit ullam iure voluptatibus odit placeat? Eligendi quisquam voluptas atque doloribus, asperiores possimus ducimus sequi! Asperiores nam voluptates numquam error odit tempore perspiciatis alias cupiditate, temporibus fugiat reiciendis voluptate praesentium nesciunt dignissimos veritatis nobis nisi neque est, consectetur possimus, distinctio pariatur magni magnam! Omnis harum debitis laudantium quos laboriosam provident quaerat, dolores est soluta commodi nam, iusto itaque quod laborum ullam? Minima tempore nesciunt, ex unde, tenetur accusantium officia ipsam autem tempora reprehenderit libero consequuntur beatae fugiat corrupti eligendi, commodi ipsum doloribus deserunt delectus voluptatem! Sapiente architecto maxime dolor iure asperiores delectus maiores ipsa saepe rerum modi officia, numquam inventore veritatis quisquam blanditiis provident odio? Inventore distinctio reiciendis et delectus sit amet quae neque accusamus recusandae rerum impedit unde in minima necessitatibus soluta ipsum dolorem reprehenderit a, iste iusto atque voluptatem? Suscipit architecto nihil consequatur veniam inventore exercitationem placeat laudantium maxime sunt, blanditiis iste eius harum neque fuga, a in ab officia praesentium rerum provident rem eligendi corporis! Odit est facere, similique aspernatur optio sit quisquam maiores molestiae! Maiores ullam tempore at cum nihil quia facere distinctio pariatur quasi animi vero dolore molestias, blanditiis corporis incidunt quis omnis eos explicabo facilis consequatur veritatis vel repellendus itaque. Sint maxime necessitatibus nostrum voluptatem ut! Accusantium tenetur minus porro error fugit, libero minima illo! Aperiam atque vel illum facere eius praesentium quibusdam ipsa alias accusantium asperiores vitae, excepturi enim quisquam quos, minima facilis odio corporis unde magni nostrum aliquam. Est consequatur, ad reprehenderit deserunt voluptates quis minus, similique dicta dolore corrupti doloribus laudantium, perspiciatis unde voluptatibus aspernatur. Aliquam!";


        foreach ($materias as $key => $materia) {
            Asignatura::create([
                'name' => $materia,
                'description' => Str::limit($p, rand(200, 300)),

            ]);
        }
        // Asignatura::factory(1)->has(Modulo::factory(1)->has(Lesson::factory()->count(1)->has(Question::factory()->count(130)->has(Option::factory()->count(5)))))->create();//


    }
}
