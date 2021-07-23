<?php

namespace Tests\Unit;

use App\CalcAdv;
use App\Calculator;
use Tests\CreatesApplication;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    use CreatesApplication;
    public $calc;
    public $calcAdv;
    public function setUp(): void
    {
        $this->createApplication();

        $this->calc = $this->getMockBuilder(Calculator::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['FunctionSum', 'FunctionSub', 'FunctionMul', 'FunctionDiv', 'FunctionPer'])
            ->addMethods(['Summation'])
            ->getMock();

        $this->calcAdv = $this->getMockBuilder(CalcAdv::class)
        ->disableOriginalConstructor()
        ->onlyMethods(['Summation'])
        ->getMock();
    }

    public function test_example()
    {
        $cal = new Calculator($this->calcAdv);

        $this->assertNotNull($cal);
        $this->assertEquals(2,$cal->FunctionPer(100, 2));
        $this->assertEquals(5,$cal->FunctionSub(7, 2));
        $this->assertEquals(4,$cal->FunctionSum(2, 2));
        $this->assertEquals(14,$cal->FunctionMul(7, 2));
        $this->assertEquals(5,$cal->FunctionDiv(10, 2));
    }
}
