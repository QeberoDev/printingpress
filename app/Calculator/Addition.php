<?php

namespace App\Calculator;

use App\Calculator\OperationInterface as OperationInterface;
use App\Calculator\Exceptions\NoOperandsException as NoOperandsException;
use App\Calculator\OperationAbstract as OperationAbstract;

class Addition extends OperationAbstract implements OperationInterface
{
	public function calculate()
	{
		if(\count($this->getOperands()) === 0) throw new NoOperandsException;
		return array_sum($this->operands);
	}
}