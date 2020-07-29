<?php

namespace App\Model;

use App\Library\Abstraction\Comparable as Comparable;
use App\Library\Abstraction\ICatagorical as ICatagorical;

class Item extends Comparable implements ICatagorical
{
	private $_name;
	private $_description;
	// TODO: Does the catagory have to be in a sub catagory or in a parent catagory too.
	private $_catagory;
	private $_shop;

	## TODO: Add Shop, Catagory, Name and Description
	public function __construct(string $name, Shop $shop, Catagory $catagory)
	{
		$this->_name = $name;
		$this->_description = "No Description Provided.";
		$this->_catagory = $catagory;
		$this->_shop = $shop;
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
	public function setCatagory(Catagory $catagory)
	{
		$this->_catagory = $catagory;
	}
	public function setShop(Shop $shop)
	{
		$this->_shop = $shop;
	}
	#endregion
	#region Getter
	public function getName()
	{
		return $this->_name;
	}
	public function getDescription()
	{
		return $this->_description;
	}
	public function getCatagory()
	{
		return $this->_catagory;
	}
	public function getShop()
	{
		$this->_shop;
	}
	#endregion
	#region CRUD
	#endregion
	#region Implementations
	## [Catagorical]
	public function addCatagory(Catagory $catagory)
	{

	}
	public function removeCatagory(Catagory $catagory)
	{

	}
	public function clearCatagory()
	{

	}
	## [Comparable]
	public function getIdentity()
	{
		
	}
	#endregion
}