<?php

namespace App\Calculator;

class Calculator
{
	protected $operations = [];

	public function setOperation(OperationInterface $operation)
	{
		$this->operations[] = $operation;
	}

	public function setOperations(array $operations)
	{
		$all_not_operations = function() use ($operations)
		{

			foreach($operations as $index => $operation)
			{
				if(!($operation instanceof OperationInterface)) return true;
			}
			return false;
		};

		if($all_not_operations()) throw new Exceptions\NotOperationException;
		$this->operations = $operations;
	}

	public function getOperations()
	{
		return $this->operations;
	}

	public function calculate()
	{
		if(count($this->operations) !== 1){
			$results = array_map(function ($operation) {
				return $operation->calculate();
			}, $this->operations);
			return $results;
		}

		return $this->operations[0]->calculate();
	}
}