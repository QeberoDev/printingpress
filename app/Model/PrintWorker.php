<?php

namespace App\Model;

use App\Model\Abstraction\IDataModel;
use App\Model\Abstraction\IPerson;

class PrintWorker implements IPerson, IDataModel
{
	protected $_id;
	protected $_name;
	protected $_phonenumber;
	protected $_address;

	public function __construct($name, $address, $phonenumber)
	{
		$this->SetName($name);
		$this->SetAddress($address);
		$this->SetPhonenumber($phonenumber);
	}
	
	#region Setter
	public function SetId(int $id)
	{
		$this->_id = $id;
	}
	public function SetName($name)
	{
		$this->_name = $name;
	}
	public function SetAddress($address)
	{
		$this->_address = $address;
	}
	public function SetPhonenumber($phonenumber)
	{
		$this->_phonenumber = $phonenumber;
	}
	#endregion
	#region Getter
	public function GetId()
	{
		return $this->_id;
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
	#endregion
}