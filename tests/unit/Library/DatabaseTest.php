<?php

use App\Library\Database;
use PHPUnit\Framework\TestCase;

class DatabaseTest extends TestCase
{
	/** @var \App\Library\Database $database */
	protected $database;
	protected $db_instance;

	/** @before */
	public function setup(): void
	{
		$this->database = new Database();
		$this->db_instance = $this->database->GetInstance();
	}
	
	/** @test */
	public function can_connect_to_database()
	{
		
	}

	/** @test */
	public function can_retrive_query_from_database()
	{
		
	}
}