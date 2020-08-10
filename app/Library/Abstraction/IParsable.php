<?php

namespace App\Library\Abstraction;

interface IParsable
{
	public static function &fromArray(array &$array);
}