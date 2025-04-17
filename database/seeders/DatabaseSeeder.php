<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Question;
use App\Models\Option;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Modulo;
use App\Models\Lesson;
use App\Models\Asignatura;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        User::factory(10)->create();
        $this->call(ModuloSeeder::class);
        User::create([
            'name' => 'Edwin Henriquez',
            'rol' => 'teacher',
            'email' => 'ed@gmail.com',
            'password' => bcrypt('123'),
            'email_verified_at' => now()
        ])->roles()->sync('2');


        User::create([
            'name' => 'Edwin Henriquez',
            'email' => 'super@gmail.com',
            'password' => bcrypt('123'),
            'email_verified_at' => now()
        ])->roles()->sync('1');
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(AsignaturaSeeder::class);
        $this->call(ModuloSeeder::class);
        $this->call(LessonSeeder::class);
        $this->call(QuestionSeeder::class);
        $this->call(OptionSeeder::class);

        $as = Asignatura::inRandomOrder()->take(2)->get();
        //dd($a->name);
        $teacher = Teacher::find(11);
        foreach ($as as $a) {
            $a->teacher_id = $teacher->id;
            $a->save();
        }


        
    }
}
