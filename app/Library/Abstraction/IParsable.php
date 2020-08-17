<?php

namespace App\Library\Abstraction;

interface IParsable
{
	public static function &FromArray(array &$array);
}