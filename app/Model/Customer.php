<?php

namespace App\Model;

use App\Library\Abstraction\Comparable as Comparable;
use App\Library\Abstraction\IParsable as IParsable;

class Customer extends Comparable
{
	const NOT_IN_DB = -999;
	
	#region
	protected $_id;
	protected $_name;
	protected $_phonenumber;
	protected $_address;
	protected $_created_date;

	/**
	 * @param string $name Name of the Customer.
	 * @param string $address Customer home address.
	 * @param string $phonenumber Customer phone number.
	 * @return void
	 */
	public function __construct(string $name, string $address, string $phonenumber)
	{
		$this->_id = $this::NOT_IN_DB;
		$this->setName($name);
		$this->_created_date = null;
		if($phonenumber) $this->setPhonenumber($phonenumber);
		if($address) $this->setAddress($address);
	}

	#region Setter
	public function setId(int $id)
	{
		$this->_id = $id;
	}
	public function setName(string $name)
	{
		$this->_name = $name;
	}
	public function setAddress(string $address)
	{
		$this->_address = $address;
	}
	public function setPhonenumber(string $phonenumber)
	{
		$this->_phonenumber = $phonenumber;
	}
	public function setCreatedDate()
	{
		
	}
	#endregion
	#region Getter
	public function getId()
	{
		return $this->_id;
	}
	public function getName()
	{
		return $this->_name;
	}
	public function getAddress()
	{
		return $this->_address;
	}
	public function getPhonenumber()
	{
		return $this->_phonenumber;
	}
	public function getCreatedDate() {

	}
	#endregion
	#region CURD
	#endregion
	#region Implementations
	## [Comparable]
	public function getIdentity()
	{
		return $this->getId();
	}
	## [IParsable]
	public static function &fromArray(array &$array)
	{
		if(
			!isset($array['id']) &&
			!isset($array['name']) &&
			!isset($array['address']) &&
			!isset($array['phonenumber'])
		){
			return; // Exit if Array not Suffecicent
		}

		$customer = new Customer($array['name'], $array['address'], $array['phonenumber']);
		$customer->setId($array['id']);
		
		return $customer;
	}
	#endregion
}