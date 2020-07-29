<?php

namespace App\Library\Util;

use OutOfBoundsException;

class ArrayOps
{
	/**
	 * returns item at key and removes it from the array.
	 * 
	 * @param array $array array we want to remove from.
	 * @param mixed $key key of the value we are removing.
	 * @param int $length key of the value we are removing.
	 * @return array
	 */
	public static function pick(array &$array, $object, $length = 1)
	{
		$item_key = array_search($object, $array);

		if(\is_bool($item_key)) return false;
		return array_splice($array, $item_key, $length);
	}

	public static function find(array &$array, mixed $object)
	{
		$item_key = array_search($object, $array);
		if(\is_bool($item_key)) return false;
		return $item_key;
	}
}