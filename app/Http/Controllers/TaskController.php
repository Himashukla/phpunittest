<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $task;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Task $task) {
        $this->task = $task;
    }
    public function index()
    {
        //dd($this->task);
        $this->task->get()->first(); 
               
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        Task::where('id',$task->id)->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy($task)
    {
        $task_to_be_deleted = Task::findOrFail($task);
        $task_to_be_deleted->delete();
        return response()->json([
            'message' => 'task deleted successfully'
        ], 410);
    }

    public function mark_task_completed(Task $task)
    {
        $task->mark_task_as_completed(); //calls the mark_task_as_complete method we created in the App/Models/Task.php file
        return response()->json([
            'message' => 'task successfully marked as updated'
        ], 200); //send a json response with the 200 status code
    }

    public function create_task(Request $request){
        $task = Task::create($request->toArray());
        return $task;
    }

}
