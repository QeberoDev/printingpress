<?php

use App\Controller\CustomerController;
use PHPUnit\Framework\TestCase;

class CustomerControllerTest extends TestCase
{
	/** @var \App\Controller\CustomerController $controller */
	protected $controller;
	/** @var \PDO $db_i */
	protected $db_i;
	
	/** @before */
	public function setup(): void
	{
		$this->controller = new CustomerController();

		$dns = "mysql:dbname=printingpress_test;host=127.0.0.1:3308";
		$username = 'root';
		$password = '';
		$this->db_i = new \PDO($dns, $username, $password);
	}

	/** @after */
	public function cleanup()
	{
		$this->controller = null;
		$this->db_i = null;
	}

	/** @test */
	public function can_count_customer_table()
	{
		$stmt = $this->db_i->prepare('SELECT COUNT(*) AS count FROM ' . $this->controller::TABLE_NAME);
		$stmt->execute();
		$row = $stmt->fetch(\PDO::FETCH_ASSOC);
		$this->assertEquals($this->controller::Count(), $row['count']);
	}

	/** @test */
	public function can_search_database()
	{
		
	}
}