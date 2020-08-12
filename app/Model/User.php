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
	protected $_account_type;
	protected $_created_date;

	public function __construct(int $employee_id, string $username, string $password)
	{
		$this->_employee_id = $employee_id;
		$this->_username = $username;
		$this->_password = $password;
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
	#endregion
	#region Implementation
	## [IParsable]
	public static function &fromArray(array &$array)
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