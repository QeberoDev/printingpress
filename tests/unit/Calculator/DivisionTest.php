<?php

use PHPUnit\Framework\TestCase as TestCase;
use App\Calculator\Exceptions\NoOperandsException as NoOperandsException;
use App\Calculator\Exceptions\DivisionByZeroExecption as DivisionByZeroExecption;
use App\Calculator\Division as Division;

class DivisionTest extends TestCase
{
	/** @test */
	public function calculating_on_zero_operands_throws_no_operands_exception()
	{
		$this->expectException(NoOperandsException::class);

		$division = new Division();
		$division->calculate();
	}
	
	/** @test */
	public function removes_operands_of_zero_value()
	{
		$division = new Division();
		$division->setOperands([10, 0, 0, 0, 5, 0]);
		$division->calculate();

		$this->assertEquals(2, $division->calculate());
	}

	/** @test */
	public function divides_given_operands()
	{
		$division = new Division();
		$division->setOperands([16, 4]);
		$this->assertEquals(4, $division->calculate());
	}

	/** @test */
	public function divides_more_than_two_operands()
	{
		$division = new Division();
		$division->setOperands([16, 4, 2, 1]);

		$this->assertEquals(2, $division->calculate());
	}
}