<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TaskTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function a_user_can_read_all_the_tasks()
    {
        $task = Task::factory()->create();

        $response = $this->get('/tasks');

        $response->assertSee($task->title);
    }

    /**
     * @test
     */
    public function a_user_can_read_single_task()
    {
        $task = Task::factory()->create();

        $response = $this->get('/tasks/'.$task->id);

        $response->assertSee($task->title)
            ->assertSee($task->description);
    }

    /**
     * @test
     */
    public function authenticated_users_can_create_a_new_task()
    {
        //
        $this->actingAs(User::factory()->create());
        //
        $task = Task::factory()->make();
        //
        $this->post('/tasks/create', $task->toArray());
        //
        $this->assertEquals(1, Task::all()->count());
    }

    /**
     * @test
     */
    public function unauthenticated_users_cannot_create_a_new_task()
    {
        $task = Task::factory()->make();

        $this->post('/tasks/create', $task->toArray())->assertRedirect('/login');
    }
}
