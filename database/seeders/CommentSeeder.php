<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        Task::all()->each(function ($task) {
            $task->comments()->saveMany(Comment::factory()->count(3)->make([
                'user_id' => User::inRandomOrder()->first()->id,
            ]));
        });
    }
}
