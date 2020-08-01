<?php

use PHPUnit\Framework\TestCase as TestCase;
use App\Calculator\Exceptions\DivisionByZeroException as DivisionByZeroException;

class DivisionTest extends TestCase
{
	/** @test */
	public function division_by_zero_throws_divisionbyzero_exception()
	{
		$this->expectException(DivisionByZeroException::class);

		$division = new Division();
		$division->setOperands([1, 0]);
	}
	
}