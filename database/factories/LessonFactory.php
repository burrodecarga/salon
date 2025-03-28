<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Modulo;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lesson>
 */
class LessonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $p="Lorem ipsum, dolor sit amet consectetur adipisicing elit. Similique quas rem eveniet illum iure quis consequuntur exercitationem eum accusantium laudantium nemo eaque excepturi libero maiores omnis harum sit distinctio iusto, beatae dicta porro. Quis maiores fugiat quod vitae expedita non molestias ipsum dolorum ea eveniet enim odit voluptatibus sequi qui, maxime sint hic fugit recusandae distinctio veritatis minima quasi aspernatur! Commodi voluptate dolores delectus, quidem, harum voluptas itaque accusantium, iste voluptates tempora nostrum? Blanditiis atque excepturi aliquam nam id? Et sapiente neque, magni placeat sint corporis quasi illo voluptas magnam amet provident officia a aliquid in, eius recusandae alias sed sit tempora? Voluptas quis illum velit nemo, libero esse officiis delectus incidunt accusantium tempora ipsum repudiandae explicabo nihil mollitia exercitationem natus necessitatibus impedit nostrum? Repudiandae sapiente eaque veritatis laudantium, ex dolorem autem adipisci ullam culpa debitis exercitationem, ut vitae ad fuga officia quibusdam, nisi et ducimus repellat reprehenderit vero soluta excepturi hic ipsa? Eius blanditiis esse alias doloribus, beatae amet minus, impedit cupiditate obcaecati saepe, eaque perferendis! Officia ex placeat rem doloremque esse, deserunt facilis laborum sit suscipit explicabo tenetur labore? Doloremque, pariatur quae laborum velit hic praesentium labore quis culpa alias excepturi magnam nihil, iusto fugiat sapiente consequuntur dolorum?";
        return [
            'name' => $this->faker->sentence(3),
            'description' => $p,
            'video' => 'para prueba',
            'modulo_id' => Modulo::factory() //
        ];
    }
}
