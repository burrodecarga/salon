<?php

namespace Database\Seeders;

use App\Models\Asignatura;
use App\Models\Option;
use App\Models\Question;
use Illuminate\Database\Seeder;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Modulo;
use App\Models\Lesson;

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
            'email' => 'ed@gmail.com',
            'password' => bcrypt('123'),
            'email_verified_at' => now()
        ])->roles()->sync('2');
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(AsignaturaSeeder::class);
    }
}
