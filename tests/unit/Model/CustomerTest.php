<?php

use App\Model\Customer;
use PHPUnit\Framework\TestCase;

class CustomerTest extends TestCase
{
	/** @var \App\Model\Customer $customer */
	protected $customer;

	/** @before */
	public function setup(): void
	{
		$this->customer = new Customer('name', '0910203040');
		$this->customer->SetAddress('address');
	}

	/** @after */
	public function cleanup()
	{
		$this->customer = null;
	}
	
	/** @test */
	public function can_create_customer()
	{
		$customer = new Customer('name', '+251910203040');

		$this->assertInstanceOf(Customer::class, $customer);
	}

	/** @test */
	public function can_set_name()
	{
		$this->customer->SetName('another name');
		$this->assertEquals('another name', $this->customer->GetName());
	}

	/** @test */
	public function can_set_phonenumber()
	{
		$this->customer->SetPhonenumber('0911223344');
		$this->assertEquals($this->customer->GetPhonenumber(), '0911223344');
	}

	/** @test */
	public function can_set_address()
	{
		$this->customer->SetAddress('another address');
		$this->assertEquals($this->customer->GetAddress(), 'another address');
	}

	/** @test */
	public function can_set_created_date()
	{
		$date = new DateTime('now');
		$date = $date->format('d-m-Y');
		$this->customer->SetCreatedDate($date);

		$this->assertEquals($date, $this->customer->GetCreatedDate());
	}
}