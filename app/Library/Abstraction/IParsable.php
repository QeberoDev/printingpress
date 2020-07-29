<?php

namespace App\Library\Abstraction;

interface IParsable
{
	public function &fromArray(array $array);
}