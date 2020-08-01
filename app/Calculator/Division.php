<?php

namespace App\Calculator;

use App\Calculator\Exceptions\NoOperandsException as NoOperandsException;
use App\Calculator\Exceptions\DivisionByZeroExecption as DivisionByZeroExecption;
use App\Calculator\OperationAbstract as OperationAbstract;

class Division extends OperationAbstract implements OperationInterface
{
	public function calculate()
	{
		if(\count($this->getOperands()) === 0) throw new NoOperandsException;

		$result = 0;
		foreach($this->operands as $index => $operand)
		{
			if($index === 0) {
				$result = $operand;
				continue;
			}

			if($operand === 0) continue;

			$result /= $operand;
		}

		return $result;
	}
}