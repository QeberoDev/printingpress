<?php

namespace App\Model;

use App\Library\Abstraction\IParsable as IParsable;
use App\Model\Abstraction\IDataModel;

class Customer implements IDataModel, IParsable
{
	/** @var int $_id */
	protected $_customer_id;
	/** @var string $_name */
	protected $_name;
	/** @var string $_phonenumber */
	protected $_phonenumber;
	/** @var string $_address */
	protected $_address;
	/** @var string $_created_date */
	protected $_created_date;

	/**
	 * @param string $name Name of the Customer.
	 * @param string $address Customer home address.
	 * @param string $phonenumber Customer phone number.
	 * @return void
	 */
	public function __construct(string $name, string $phonenumber)
	{
		$this->_id = null;
		$this->setName($name);
		$this->_created_date = null;
		if($phonenumber) $this->setPhonenumber($phonenumber);
	}

	#region Setter
	public function SetId(int $id)
	{
		$this->_customer_id = $id;
	}
	public function SetName(string $name)
	{
		$this->_name = $name;
	}
	public function SetAddress(string $address)
	{
		$this->_address = $address;
	}
	public function SetPhonenumber(string $phonenumber)
	{
		$this->_phonenumber = $phonenumber;
	}
	public function SetCreatedDate($created_date)
	{
		$this->_created_date = $created_date;
	}
	#endregion
	#region Getter
	public function GetId()
	{
		return $this->_customer_id;
	}
	public function GetName()
	{
		return $this->_name;
	}
	public function GetAddress()
	{
		return $this->_address;
	}
	public function GetPhonenumber()
	{
		return $this->_phonenumber;
	}
	public function GetCreatedDate()
	{
		return $this->_created_date;
	}
	#endregion
	#region Implementations
	## [IParsable]
	public static function &fromArray(array &$array)
	{
		if(
			!isset($array['customer_id']) &&
			!isset($array['name']) &&
			!isset($array['phonenumber'])
		){
			return; // Exit if Array not Suffecicent
		}

		$customer = new Customer($array['name'], $array['phonenumber']);
		if(isset($array['customer_id'])) $customer->SetId($array['customer_id']);
		
		return $customer;
	}
	#endregion
}