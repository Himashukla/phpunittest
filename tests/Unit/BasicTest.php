<?php

namespace Tests\Unit;

use App\Calculator;
use App\Models\Task;
use Tests\CreatesApplication;
use PHPUnit\Framework\TestCase;
use App\Http\Controllers\TaskController;
use Illuminate\Database\Query\Builder as QueryBuilder;

class BasicTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    use CreatesApplication;
    public $calc;
    public $task;
    public $queryBuilder;
    public $tasks;

    public function setUp(): void
    {
        $this->createApplication();

        $this->calc = $this->getMockBuilder(Calculator::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['FunctionSum', 'FunctionSub', 'FunctionMul', 'FunctionDiv', 'FunctionPer'])
            ->addMethods(['Summation'])
            ->getMock();

        $this->task = $this->getMockBuilder(TaskController::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['create_task','index'])
            //->addMethods(['is_completed','mark_task_as_completed'])
            ->getMock();

        $this->queryBuilder = $this->getMockBuilder(QueryBuilder::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['select', 'get', 'first','where'])
            ->getMock();
        
        $this->tasks = $this->getMockBuilder(Task::class)
        ->disableOriginalConstructor()
        ->addMethods(['get','where','first'])
        ->getMock();

        $this->tasks->id = 1;

    }

    public function test_example()
    {
        $this->calc->expects($this->once())
            ->method('Summation')
            ->with(2, 2, 2)
            ->willReturn($this->returnValue(6));

        $this->calc->Summation(2, 2, 2);

        // $this->task->expects($this->once())
        // ->method('is_completed');

        // $this->task = Task::find(15);
        // $this->assertEquals(1,$this->task->is_completed());
        // //$this->assertNotNull($this->task->is_completed());
    }

    public function testIndexMethod(){        

        //dd($this->tasks);
        $this->tasks->expects($this->once())
            ->method('get')
            ->willReturn($this->queryBuilder);
        
        $this->queryBuilder->expects($this->once())
            ->method('first')
            ->willReturn($this->getTasks());
            
        $index = new TaskController($this->tasks);

        $index->index();
    }

    public function testShowMethod(){        

        //dd($this->tasks);
        
        $this->queryBuilder->expects($this->once())
            ->method('where')
            ->with($this->tasks->id)
            ->willReturn($this->queryBuilder);

        $this->queryBuilder->expects($this->once())
            ->method('first')
            ->willReturn($this->getTasks());
            
        $index = new TaskController($this->tasks);
        //dd($this->tasks);
        $index->show($this->tasks);
    }

    public function getTasks()
    {
        $opportunity = new Task();

        return $opportunity;
    }
}
