<?php

use App\Calculator\Addition;
use PHPUnit\Framework\TestCase;
use App\Calculator\Calculator;
use App\Calculator\Division;
use App\Calculator\Exceptions\NotOperationException;

class CalculatorTest extends TestCase
{
	/** @test */
	public function can_set_single_operation()
	{
		$addition = new Addition();
		$addition->setOperands([5, 10]);

		$calculator = new Calculator();
		$calculator->setOperation($addition);

		$this->assertCount(1, $calculator->getOperations());
	}

	/** @test */
	public function can_set_multiple_operations()
	{
		$addition1 = new Addition();
		$addition1->setOperands([5, 10]);

		$addition2 = new Addition();
		$addition2->setOperands([7, 14]);

		$calculator = new Calculator();
		$calculator->setOperations([$addition1, $addition2]);

		$this->assertCount(2, $calculator->getOperations());
	}

	/** @test */
	public function setting_non_operation_throws_not_operation_exception()
	{
		$this->expectException(TypeError::class);
		
		$calculator = new Calculator();
		$calculator->setOperation(1);
	}

	/** @test */
	public function setting_an_array_containing_non_operation_throws_not_operation_exception()
	{
		$this->expectException(NotOperationException::class);

		$calculator = new Calculator();
		$calculator->setOperations([1, 2 , 3]);
	}

	/** @test */
	public function can_calculate_result()
	{
		$addition = new Addition();
		$addition->setOperands([5, 10]);

		$calculator = new Calculator();
		$calculator->setOperation($addition);

		$this->assertEquals(15, $calculator->calculate());
	}

	/** @test */
	public function can_calculate_multiple_results()
	{
		$addition = new Addition();
		$addition->setOperands([5, 10]);

		$division = new Division();
		$division->setOperands([6, 2]);

		$calculator = new Calculator();
		$calculator->setOperations([$addition, $division]);

		$this->assertIsArray($calculator->calculate());
		$this->assertEquals(15, $calculator->calculate()[0]);
		$this->assertEquals(3, $calculator->calculate()[1]);
	}
}