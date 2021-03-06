<?php

use App\Controller\CustomerController;
use App\Model\Customer;
use PHPUnit\Framework\TestCase;

class CustomerControllerTest extends TestCase
{
	/** @var \App\Controller\CustomerController $controller */
	protected $controller;
	/** @var \PDO $db_instance */
	protected $db_instance;
	
	/** @before */
	public function setup(): void
	{
		$this->controller = new CustomerController();

		$dns = "mysql:dbname=printingpress_test;host=127.0.0.1:3308";
		$username = 'root';
		$password = '';
		$this->db_instance = new \PDO($dns, $username, $password);
	}

	/** @after */
	public function cleanup()
	{
		$this->controller = null;
		$this->db_instance = null;
	}

	/** @test */
	public function can_count_customer_from_database()
	{
		$stmt = $this->db_instance->prepare('SELECT COUNT(*) AS count FROM ' . $this->controller::TABLE_NAME);
		$stmt->execute();
		$row = $stmt->fetch(\PDO::FETCH_ASSOC);
		$this->assertEquals($this->controller::Count(), $row['count']);
	}

	/** @test */
	public function can_read_customer_from_database()
	{
		$sql = "SELECT * FROM " . CustomerController::TABLE_NAME . " WHERE customer_id = :id";
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

		$customerObj = new Customer($row['name'], $row['phonenumber']);
		
		/** @var \App\Model\Customer $controllerResult */
		$controllerResult = $this->controller->Read(1);


		$this->assertEquals($controllerResult->GetName(), $customerObj->GetName());
		$this->assertEquals($controllerResult->GetPhonenumber(), $customerObj->GetPhonenumber());
	}

	/** @test */
	public function can_create_customer_in_database()
	{
		$createResult = $this->controller::Create("Abebe Biqila", "+251 92 345 4455");
		$readResult = $this->controller->Read($createResult->GetId());
		
		$this->assertEquals($readResult->GetId(), $createResult->GetId());
		$this->assertEquals($readResult->GetName(), $createResult->GetName());
		$this->assertEquals($readResult->GetPhonenumber(), $createResult->GetPhonenumber());

		$this->controller::Delete($createResult->GetId());
	}

	/** @test */
	public function can_remove_customer_from_database()
	{
		$createdCustomer = $this->controller::Create("Shambel Danhe", "0911223344");
		$this->controller->Delete($createdCustomer->GetId());

		$this->assertNull($this->controller::Read($createdCustomer->GetId()));
	}

	/** @test */
	public function can_search_for_customer_by_name_in_database()
	{
		/** @var App\Model\Customer $createdCustomer1*/
		$createdCustomer1 = $this->controller::Create('Biftu Tulu 2', '0933221144');
		/** @var App\Model\Customer $createdCustomer2 */
		$createdCustomer2 = $this->controller::Create('Biftu Tulu 1', '0933221155');
		
		$searchedCustomer = $this->controller::Search([
			'name' => "Biftu Tulu"
		]);

		$this->assertCount(2, $searchedCustomer);
		$this->assertEquals($createdCustomer1->GetPhonenumber(), $searchedCustomer[0]->GetPhonenumber());
		$this->assertEquals($createdCustomer2->GetPhonenumber(), $searchedCustomer[1]->GetPhonenumber());

		$this->controller::Delete($createdCustomer1->GetId());
		$this->controller::Delete($createdCustomer2->GetId());
	}

	/** @test */
	public function can_search_for_customer_by_phonenumber_in_database()
	{
		$createdCustomer1 = $this->controller::Create('Girma Achiru', '0911321166');
		$createdCustomer2 = $this->controller::Create('Girma Rejemu', '0911321177');

		$searchedCustomer = $this->controller::Search([
			'phonenumber' => "09113211"
		]);

		$this->assertCount(2, $searchedCustomer);
		$this->assertEquals($createdCustomer1->GetPhonenumber(), $searchedCustomer[0]->GetPhonenumber());
		$this->assertEquals($createdCustomer2->GetPhonenumber(), $searchedCustomer[1]->GetPhonenumber());

		$this->controller::Delete($createdCustomer1->GetId());
		$this->controller::Delete($createdCustomer2->GetId());
	}

	/** @test */
	public function can_search_for_cusotomer_by_address_in_database()
	{
		$createdCustomer1 = $this->controller::Create("Gemechu Bonsa", "0988776655", "Gende Hara");
		$createdCustomer2 = $this->controller::Create("Rebira Biqila", "0976665411", "Gende Hara");

		$searchedCustomer = $this->controller::Search([
			'address' => "Gende Ha"
		]);

		$this->assertCount(2, $searchedCustomer);
		$this->assertEquals($createdCustomer1->GetId(), $searchedCustomer[0]->GetId());
		$this->assertEquals($createdCustomer2->GetId(), $searchedCustomer[1]->GetId());

		$this->controller::Delete($createdCustomer1->GetId());
		$this->controller::Delete($createdCustomer2->GetId());
	}

	/** @test */
	public function can_search_for_customer_by_name_address_and_phonenumber()
	{
		$createdCustomer1 = $this->controller::Create("Gemechu Bonsa", "0909090988", "Maya Hotel");
		$createdCustomer2 = $this->controller::Create("Gemechu Binsa", "0909090989", "Maya Hotel");

		$searchedCustomer = $this->controller::Search([
			'name' => "Gemechu",
			'phonenumber' => "090909",
			'address' => "Maya"
		]);

		$this->assertCount(2, $searchedCustomer);
		$this->assertEquals($createdCustomer1->GetId(), $searchedCustomer[0]->GetId());
		$this->assertEquals($createdCustomer2->GetId(), $searchedCustomer[1]->GetId());

		$this->controller::Delete($createdCustomer1->GetId());
		$this->controller::Delete($createdCustomer2->GetId());
	}	
}
