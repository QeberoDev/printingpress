<?php

use App\Controller\AdminController;
use PHPUnit\Framework\TestCase;

class AdminControllerTest extends TestCase
{
	/** @var App\Controller\AdminController */
	protected $controller;
	protected $db_instance;

	/** @before */
	public function setup(): void
	{
		$dns = "mysql:dbname=printingpress_test;host=127.0.0.1:3308";
		$username = 'root';
		$password = '';
		
		$this->db_instance = new \PDO($dns, $username, $password);
	}

	/** @after */
	public function cleanup()
	{
		$this->db_instance = null;
	}

	public function can_create_admin_in_database()
	{
		$admin = AdminController::Create('uname1', 'pass1');
	}
}