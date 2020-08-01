<?php

namespace App\Calculator;

use App\Calculator\Exceptions\NoOperandsException as NoOperandsException;
use App\Calculator\Exception\DivisionByZeroException as DivisionByZeroException;

class Division extends Operation implements OperationInterface
{
	public function calculate()
	{
		if(calculate($this->operands) === 0) throw new NoOperandsException();
	}
}