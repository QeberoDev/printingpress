<?php

namespace App\Library;

class Database
{
	private const HOST = "127.0.0.1:3308";
	private const USERNAME = "root";
	private const PASSWORD = "";
	private const DATABASE = "printingpress_test";
	
	protected $__dbInstance;

	public function __construct()
	{
		$dns = "mysql:dbname=" . $this::DATABASE . ";host=" . $this::HOST; 
		$this->__dbInstance = new \PDO($dns, $this::USERNAME, $this::PASSWORD);
	}

	#region Methods
	public function GetInstance()
	{
		return $this->__dbInstance;
	}
	#endregion
}