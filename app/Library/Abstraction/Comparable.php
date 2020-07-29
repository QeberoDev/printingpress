<?php

namespace App\Library\Abstraction;

/**
 * Adds Comparable Functionality to Objects.
 * @method getIdentity
 * @method isEqual
 */
abstract class Comparable
{
	/**
	 * Returns the identifying property for Object
	 * 
	 * @return mixed
	 */
	public abstract function getIdentity();
	/**
	 * If the item is similar returns true.
	 * else returns false.
	 * 
	 * @param \App\Model\Abstraction\IComparable $item
	 * @return bool
	 */
	public function isEqual(Comparable $item)
	{
		return ($this->getIdentity() === $item->getIdentity()) ? true : false;
	}
}