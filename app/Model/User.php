<?php

namespace App\Model;

use App\Library\Abstraction\IParsable;
use App\Model\Abstraction\IDataModel;

class User implements IDataModel, IParsable
{
	protected $_id;
	protected $_employee_id;
	protected $_username;
	protected $_password;
	protected $_employee_type;
	protected $_created_date;
	protected $_active;

	public function __construct(string $username, string $password, Employee $employee = null)
	{
		if(isset($employee)) $this->SetEmployee($employee);
		$this->SetUsername($username);
		$this->SetPassword($password);
	}
	
	#region Setter
	public function SetId(int $id)
	{
		$this->_id = $id;
	}
	public function SetEmployeeId(int $id)
	{
		$this->_employee_id = $id;
	}
	public function SetEmployeeType(string $employeeType)
	{
		$this->_employee_type = $employeeType;
	}
	public function SetEmployee(Employee $employee)
	{
		$this->SetEmployeeId($employee->GetId());
		$this->SetEmployeeType(get_class($employee));
	}
	public function SetUsername(string $username)
	{
		$this->_username = $username;
	}
	public function SetPassword(string $password)
	{
		$this->_password = $password;
	}
	public function SetCreatedDate(string $date)
	{
		$this->_created_date = $date;
	}
	public function SetAccountType(int $account_type)
	{
		$this->_account_type = $account_type;
	}
	public function SetActive(bool $is_active)
	{
		$this->_active = $is_active;
	}
	#endregion
	#region Getter
	public function GetId()
	{
		return $this->_id;
	}
	public function GetUsername()
	{
		return $this->_username;
	}
	public function GetPassword()
	{
		return $this->_password;
	}
	public function GetEmployeeId()
	{
		return $this->_employee_id;
	}
	public function GetCreatedDate()
	{
		return $this->_created_date;
	}
	public function IsActive()
	{
		return $this->_active;
	}
	#endregion
	#region Implementation
	## [IParsable]
	public static function &FromArray(array &$array)
	{
		if(
			!isset($array['employee_id']) &&
			!isset($array['username']) &&
			!isset($array['password']) &&
			!isset($array['created_date'])
		) return;

		$user_id = $array['user_id'];
		$employee_id = $array['employee_id'];
		$username = $array['username'];
		$password = $array['password'];
		$created_date = $array['created_date'];
		
		$user = new User($employee_id, $username, $password);
		$user->SetId($user_id);
		$user->SetCreatedDate($created_date);

		return $user;
	}
	#endregion
}