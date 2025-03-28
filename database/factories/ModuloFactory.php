<?php

namespace Database\Factories;

use App\Models\Asignatura;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Modulo>
 */
class ModuloFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $p="Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam placeat esse laboriosam animi qui exercitationem dolore saepe, amet quia, tempora voluptatibus. Hic cumque minima quasi ab illo incidunt dolores quia, ex consequuntur possimus quisquam libero nisi asperiores sed odit voluptates cupiditate sapiente molestiae eius id soluta molestias. Maxime, rem suscipit. Similique accusantium nulla itaque, quis cupiditate dolores asperiores! Hic libero, dolor animi sunt architecto, soluta velit optio non vitae fuga esse quidem sed dicta nihil veniam reprehenderit nisi. Quasi libero odit repellat sequi exercitationem vitae, neque eos adipisci maiores perspiciatis corporis voluptatum obcaecati est architecto deserunt, magni culpa fugit, numquam pariatur. Officiis laboriosam autem asperiores, aut fugit sapiente nulla voluptates quam, molestiae possimus quibusdam, molestias corporis quo neque eveniet quidem sequi facere quaerat alias! Voluptate rem dolore dolorem officia aut distinctio explicabo nostrum ipsam, nam delectus necessitatibus nesciunt pariatur. Illo dignissimos nulla sequi nisi. Consequatur quibusdam id laborum voluptatibus fugit similique autem excepturi sint maxime sunt impedit, vitae iusto quod error natus corrupti ab quae quidem nisi laudantium earum sed obcaecati aspernatur. Voluptas molestiae praesentium, odit numquam delectus nesciunt dolorum.";
        return [
            'name' => $this->faker->sentence(),
            'description' => $p, //
            'asignatura_id' => Asignatura::factory()
        ];
    }
}
