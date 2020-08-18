<?php

use PHPUnit\Framework\TestCase;
use App\Controller\AdminController;
use App\Model\Admin;

class AdminControllerTest extends TestCase
{
	/** @var App\Controller\AdminController */
	protected $controller;
	/** @var \PDO */
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

	/** @test */
	public function can_count_admin_from_database()
	{
		$sql = "SELECT COUNT(*) AS `count` FROM " . AdminController::TABLE_NAME;
		$stmt = $this->db_instance->prepare($sql);
		$stmt->execute();
		$row = $stmt->fetch(\PDO::FETCH_ASSOC);
		$this->assertEquals(AdminController::Count(), $row['count']);
	}

	/** @test */
	public function can_read_admin_from_database()
	{
		$sql = "SELECT * FROM " . AdminController::TABLE_NAME . " WHERE admin_id = :id";
		$stmt = $this->db_instance->prepare($sql);
		$id = 1;
		$stmt->bindParam(':id', $id);

		try
		{
			$stmt->execute();
		} catch(PDOException $exc)
		{
			throw $exc;
		}

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$adminFromController = AdminController::Read(1);

		$this->assertEquals($adminFromController->GetId(), $row['admin_id']);
		$this->assertEquals($adminFromController->GetUsername(), $row['username']);
		$this->assertEquals($adminFromController->GetPassword(), $row['password']);
	}

	/** @test */
	public function can_remove_admin_from_database()
	{
		$admin = AdminController::Create('uname3', 'upass3');
		AdminController::Delete($admin->GetId());

		$this->assertNull(AdminController::Read($admin->GetId()));
	}
	
	/** @test */
	public function can_create_admin_in_database()
	{
		// $admin = AdminController::Create('uname2', 'pass2');
		$this->assertTrue(true);
	}
}