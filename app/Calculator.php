<?php

namespace App;

use App\CalcAdv;

class Calculator
{    
    public $calcAdv;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(CalcAdv $calcAdv) {
        $this->calcAdv = $calcAdv;
    }

    public function handle()
    {
        $this->calcAdv = $this->calcAdv->Summation(10,10,10);
    }

    
    public function FunctionSum($a, $b)
    {
        return $a + $b;
    }

    public function FunctionSub($a, $b)
    {
        return $a - $b;
    }

    public function FunctionMul($a, $b)
    {
        return $a * $b;
    }

    public function FunctionDiv($a, $b)
    {
        return $a / $b;
    }

    public function FunctionPer($a, $percentage)
    {
        return ($a * $percentage) / 100;
    }
}
