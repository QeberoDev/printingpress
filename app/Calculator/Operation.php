<?php

namespace App\Calculator;

abstract class Operation
{
	protected $operands = [];

	public function setOperands(array $operands)
	{
		$this->$operands = $operands;
	}

	public function getOperands()
	{
		return $this->operands;
	}
}