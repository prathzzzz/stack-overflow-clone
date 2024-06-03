<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create()
            ->each(function ($user) {
                for ($i = 1; $i <= rand(5, 10); $i++) {
                    $user->questions()
                        ->create(Question::factory()->make()->toArray());
                }
            });
    }
}
