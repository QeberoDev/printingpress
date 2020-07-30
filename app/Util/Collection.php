<?php

namespace App\Util;

use ArrayIterator;
use IteratorAggregate;

class Collection implements IteratorAggregate
{
	protected $items = [];

	public function __construct(array $items = [])
	{
		$this->items = $items;
	}
	public function get()
	{
		return $this->items;
	}
	public function count()
	{
		return count($this->items);
	}
	public function merge(self $collection)
	{
		$this->items = array_merge($this->items, $collection->get());
	}

	## Abstracts & Interface Implementations
	# [IteratorAggregate]
	public function getIterator()
	{
		return new ArrayIterator($this->items);
	}
}
