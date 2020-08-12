<?php

use App\Library\Database;
use PHPUnit\Framework\TestCase;

class DatabaseTest extends TestCase
{
	/** @var \App\Library\Database $database */
	protected $database;
	/** @var \PDO $db_instance */
	protected $db_instance;
	const TABLE_NAME = 'test';

	/** @before */
	public function setup(): void
	{
		$this->database = new Database();
		$this->db_instance = $this->database->GetInstance();
	}
	
	/** @test */
	public function can_connect_to_database()
	{
		$stmt = $this->db_instance->prepare('select 1');
		$this->assertTrue($stmt->execute());
	}

	/** @test */
	public function can_query_the_database()
	{
		$stmt = $this->db_instance->prepare('select 1 as one');
		$stmt->execute();

		$row = $stmt->fetch(\PDO::FETCH_ASSOC);
		$this->assertEquals($row['one'], 1);
	}
}