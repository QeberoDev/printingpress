<?php

use PHPUnit\Framework\TestCase as TestCase;
use App\Calculator\Addition as Addition;
use App\Calculator\Exceptions\NoOperandsException as NoOperandsException;

class AdditionTest extends TestCase
{
	/** @test */
	public function adds_up_given_operands()
	{
		$addition = new Addition();
		$addition->setOperands([5, 10]);
		$this->assertEquals(15, $addition->calculate());
	}
	
	/** @test */
	public function no_operands_given_throws_exception_when_calculated()
	{
		$this->expectException(NoOperandsException::class);
		
		$addition = new Addition();
		$addition->calculate();
	}
}