<?php

namespace App\Model;

use App\Library\Abstraction\IParsable;
use App\Model\Abstraction\IDataModel;

class Admin implements IDataModel, IParsable
{
	protected $_id;
	protected $_username;
	protected $_password;
	protected $_created_date;

	public function __construct(string $username, string $password)
	{
		$this->SetUsername($username);
		$this->SetPassword($password);
	}

	#region Setter
	public function SetId(int $id)
	{
		$this->_id = $id;
	}
	public function SetUsername($username)
	{
		$this->_username = $username;
	}
	public function SetPassword($password)
	{
		$this->_password = $password;
	}
	public function SetCreatedDate($created_date)
	{
		$this->_created_date = $created_date;
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
	public function GetCreatedDate()
	{
		return $this->_created_date;
	}
	#endregion
	#region Implementation
	# [IParsable]
	public static function &FromArray(array &$array)
	{
		if(
			!isset($array['admin_id']) &&
			!isset($array['username']) &&
			!isset($array['password']) &&
			!isset($array['created_date'])
		) return;

		$admin = new Admin($array['username'], $array['password']);
		$admin->SetId($array['admin_id']);
		$admin->SetCreatedDate($array['created_date']);

		return $admin;
	}
	#endregion
}