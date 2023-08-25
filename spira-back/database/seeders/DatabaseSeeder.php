<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);

        $users = User::factory(1)->create();
        foreach ($users as $user) {
            $user->assignRole('admin');
        }

        $users = User::factory(5)->create();
        foreach ($users as $user) {
            $user->assignRole('student');
        }

        \App\Models\Course::factory(30)->create();
        \App\Models\Classroom::factory(30)->create();

    }
}
