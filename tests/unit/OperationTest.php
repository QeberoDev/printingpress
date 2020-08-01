<?php

use PHPUnit\Framework\TestCase as TestCase;
use App\Calculator\Operation as Operation;

class OperationTest extends TestCase
{
	protected $concreteOperation;
	
	public function setUp(): void
	{
		$this->concreteOperation = new class extends Operation {};
	}

	/** @test */
	public function can_set_operands()
	{
		$operation =& $this->concreteOperation;
		$operation->setOperands();
	}
}