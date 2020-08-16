<?php

namespace App\Model;

use App\Model\Abstraction\IDataModel;

class Admin implements IDataModel
{
	protected $_id;
	protected $_username;
	protected $_password;
	protected $_created_date;

	public function __construct($username, $password)
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
}