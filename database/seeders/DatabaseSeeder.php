<?php

namespace Database\Seeders;

use App\Models\Answer;
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
                $user->questions()
                    ->saveMany(Question::factory(rand(3, 10))->make())
                    ->each(function ($question) {
                        $question->answers()
                            ->saveMany(
                                Answer::factory(rand(3, 7))
                                    ->make()
                            );
                    });
            });
    }
}
