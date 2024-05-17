<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class TaskTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_list_task_page(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('task.index'));

        $response->assertStatus(200);
    }

    public function test_show_task_page(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $task = $user->tasks()->create([
            'title' => 'test',
            'description' => 'test',
            'due_date' => now(),
            'status' => 'open',
        ]);
        $response = $this->get(route('task.show', $task));
        $response->assertStatus(200);
    }

    public function test_create_task_page(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('task.create'));
        $response->assertStatus(200);
    }

    public function test_store_task(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $task = $user->tasks()->create([
            'title' => 'test',
            'description' => 'test',
            'due_date' => now(),
            'status' => 'open',
        ]);
        $response = $this->get(route('task.index', $task));
        $response->assertStatus(200);
    }

    public function test_edit_task(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $task = $user->tasks()->create([
            'title' => 'test',
            'description' => 'test',
            'due_date' => now(),
            'status' => 'open',
        ]);
        $response = $this->get(route('task.edit', $task));
        $response->assertStatus(200);
    }



    public function test_update_task(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $task = $user->tasks()->create([
            'title' => 'test',
            'description' => 'test',
            'due_date' => now(),
            'status' => 'open',
        ]);
        $response = $this->get(route('task.index', $task));
        $response->assertStatus(200);
    }
}
