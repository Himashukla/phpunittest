<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InsertionTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_that_a_task_can_be_added()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('tasks/create', [
            'name' => 'Write Article',
            'description' => 'Write and publish an article'
        ]);
        $response->assertStatus(201);
        $this->assertTrue(count(Task::all()) > 1);
    }
    
    public function test_that_a_task_can_be_deleted()
    {
        $this->withoutExceptionHandling();
        Task::factory()->times(5)->create(); // create 5 tasks using the factory setup above
        $id_to_be_deleted = random_int(1, 5); // select a random task
        $this->delete("tasks/$id_to_be_deleted/"); // send a request to delete it
        $this->assertDatabaseMissing('tasks', ['id' => $id_to_be_deleted]); // assert that the task deleted previouly does not exist in the database anymore.
    }

    public function test_that_a_task_can_be_completed(){
        $this->withoutExceptionHandling();
        $task_id = Task::create([
              'name' => 'Example Name',
              'description' => 'Demo dscription'
        ])->id; // create a task and store the id in the $task_id variable
        $response = $this->patch("tasks/$task_id/complete"); //sends a patch request in order to complete the created task
        $this->assertTrue(Task::findOrFail($task_id)->is_completed() == 1); // assert that the task is now marked as completed in the database
        $response->assertJson([
                  'message' => 'task successfully marked as updated'
        ], true); // ensure that the JSON response recieved contains the message specified
        $response->assertStatus(200); // furthe ensures that a 200 response code is recieved from the patch request
    }
    
}
