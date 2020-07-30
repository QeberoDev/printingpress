<?php

namespace App\Util;

use ArrayIterator;
use IteratorAggregate;
use JsonSerializable;

class Collection implements IteratorAggregate, JsonSerializable
{
	protected $items = [];

	public function __construct(array $items = [])
	{
		$this->items = $items;
	}

	public function add(array $items)
	{
		$this->items = array_merge($this->items, $items);
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
		$this->add($collection->get());
	}
	public function toJson()
	{
		return json_encode($this->items);
	}

	## Abstracts & Interface Implementations
	# [IteratorAggregate]
	public function getIterator()
	{
		return new ArrayIterator($this->items);
	}
	public function jsonSerialize()
	{
		return $this->items;
	}
}
