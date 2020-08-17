<?php

use App\Model\Employee;
use App\Model\User as User;

class UserTest extends \PHPUnit\Framework\TestCase
{
	/** @var \App\Model\User */
	protected $user;
	
	/** @before */
	public function setUp(): void
	{
		$employee = new Employee('Chala', 'Gadiso', 'Ezihu Man', '0911223344', 'mail@domain.com');
		$employee->SetId(25);
		
		$this->user = new User('empname1', 'emppass1', $employee);
		$this->user->SetEmployee($employee);
	}

	/** @after */
	public function cleanup()
	{
		$this->user = null;
	}

	/** @test */
	public function can_create_user()
	{
		$this->assertEquals($this->user->GetUsername(), 'empname1');
		$this->assertEquals($this->user->GetPassword(), 'emppass1');
		$this->assertEquals($this->user->GetEmployeeId(), 25);
	}

	/** @test */
	public function can_set_employee()
	{
		$employee = new Employee('Chaltu', 'Gadiso', 'Eza Man', '0922334455', 'mymail@domain.com');
		$employee->SetId(23);

		$this->user->SetEmployee($employee);
		
		$this->assertEquals($this->user->GetEmployeeId(), '23');
	}

	/** @test */
	public function can_set_employee_id()
	{
		$this->user->SetEmployeeId(12);
		$this->assertEquals($this->user->GetEmployeeId(), 12);
	}

	/** @test */
	public function can_set_username()
	{
		$this->user->SetUsername('uname');
		$this->assertEquals($this->user->GetUsername(), 'uname');
	}

	/** @test */
	public function can_set_password()
	{
		$this->user->SetPassword('pword');
		$this->assertEquals($this->user->GetPassword(), 'pword');
	}

	/** @test */
	public function can_set_created_date()
	{
		$this->user->SetCreatedDate('10-22-2020');
		$this->assertEquals($this->user->GetCreatedDate(), '10-22-2020');
	}

	/** @test */
	public function can_set_active()
	{
		$this->user->SetActive(true);
		$this->assertTrue($this->user->IsActive());

		$this->user->SetActive(false);
		$this->assertFalse($this->user->IsActive());
	}
}