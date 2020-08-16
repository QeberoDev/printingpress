<?php

namespace App\Model;

use App\Model\Abstraction\IDataModel;
use App\Model\Abstraction\IEmployee;

class Employee implements IDataModel, IEmployee
{
	protected $_employee_id;
	protected $_first_name;
	protected $_last_name;
	protected $_phonenumber;
	protected $_employee_type_id;
	protected $_address;
	protected $_email;

	public function __construct($first_name, $last_name, $address, $phonenumber, $email)
	{
		$this->SetFirstName($first_name);
		$this->SetLastName($last_name);
		$this->SetAddress($address);
		$this->SetPhonenumber($phonenumber);
		$this->SetEmail($email);
	}
	
	#region Setter
	public function SetId(int $id)
	{
		$this->_employee_id = $id;
	}
	public function SetFirstName($first_name)
	{
		$this->_first_name = $first_name;
	}
	public function SetLastName($last_name)
	{
		$this->_last_name = $last_name;
	}
	public function SetFullName($firstname, $lastname)
	{
		$this->SetFirstName($firstname);
		$this->SetLastName($lastname);
	}
	public function SetAddress($address)
	{
		$this->_address = $address;
	}
	public function SetPhonenumber($phonenumber)
	{
		$this->_phonenumber = $phonenumber;
	}
	public function SetEmail($email)
	{
		$this->_email = $email;
	}
	#endregion
	#region Getter
	public function GetId()
	{
		return $this->_employee_id;
	}
	public function GetFirstName()
	{
		return $this->_first_name;
	}
	public function GetLastName()
	{
		return $this->_last_name;
	}
	public function GetFullName()
	{
		return $this->GetFirstName() . ' ' . $this->GetLastName();
	}
	public function GetAddress()
	{
		return $this->_address;
	}
	public function GetPhonenumber()
	{
		return $this->_phonenumber;
	}
	public function GetEmail()
	{
		return $this->_email;
	}
	#endregion
}