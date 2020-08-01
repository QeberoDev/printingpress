<?php

use App\Calculator\OperationAbstract;
use PHPUnit\Framework\TestCase;

class OperationAbstractTest extends TestCase
{
	/** @test */
	public function can_set_operands()
	{
		$concreteOperation = new class extends OperationAbstract {};
		$concreteOperation->setOperands([1, 2, 3]);

		$this->assertContains(1, $concreteOperation->getOperands());
		$this->assertContains(2, $concreteOperation->getOperands());
		$this->assertContains(3, $concreteOperation->getOperands());
	}
}