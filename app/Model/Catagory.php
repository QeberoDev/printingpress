<?php

namespace App\Model;

use App\Library\Abstraction\Comparable as Comparable;

class Catagory extends Comparable
{
	## Property
	private $_name;
	private $_description;
	private $_subcatagory;

	public function __construct(string $name, string $description = NULL)
	{
		$this->_name = $name;
		$this->_description = $description;
		$this->_subcatagory = array(); // making array
	}
	
	#region Setter
	public function setName(string $name)
	{
		$this->_name = $name;
	}
	public function setDescription(string $description)
	{
		$this->_description = $description;
	}
	#endregion
	#region Getter
	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->_name;
	}

	/**
	 * @return string
	 */
	public function getDescription()
	{
		return $this->_description;
	}
	#endregion
	#region Add/Remove Methods
	## FIXME: SubCatagory needs to be fixed
	/**
	 * @param \App\Model\Catagory $catagory
	 */
	public function addSubcatagory(Catagory $catagory)
	{
		
		if($this->countSubcatagory() == array_push($this->_subcatagory, $catagory)) return false;
		return true;
	}
	/**
	 * @return int
	 */
	public function countSubcatagory()
	{
		return count($this->_subcatagory);
	}
	/**
	 * @return bool
	 */
	public function removeSubcatagory(Catagory $catagory)
	{
		foreach ($this->_subcatagory as $key => $value) {
			if($value->getName() === $catagory->getName())
				var_dump(NULL);
		}
	}
	/**
	 * @return array
	 */
	public function getSubcatagories()
	{
		return $this->_subcatagory;
	}
	#endregion
	#region Implementations
	## [Comparable]
	public function getIdentity()
	{
		return $this->_name;
	}
	#endregion
}