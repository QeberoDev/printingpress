<?php

namespace App\Model;

use App\Library\Abstraction\Comparable as Comparable;

class Shop extends Comparable
{
	## Property
	private $_name;
	private $_owner;
	private $_location;

	public function __construct(string $name, string $owner, string $location)
	{
		$this->_name = $name;
		$this->_owner = $owner;
		$this->_location = $location;
	}

	#region Setter
	public function setName(string $name)
	{
		$this->_name = $name;
	}
	## TODO: Owner & Location must be an objects
	public function setOwner(string $owner)
	{
		$this->_owner = $owner;
	}
	public function setLocation(string $location)
	{
		$this->_location = $location;
	}
	#endregion
	#region Getter
	public function getName()
	{
		return $this->_name;
	}
	public function getOwner()
	{
		return $this->_owner;
	}
	public function getLocation()
	{
		return $this->_location;
	}
	#endregion
	#region CRUD

	#endregion
	#region Implementations
	## [Comparable]
	public function getIdentity()
	{
		return $this->_name;
	}
	#endregion
}