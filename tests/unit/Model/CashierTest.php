<?php

use App\Model\Cashier;
use PHPUnit\Framework\TestCase;

class CashierTest extends TestCase
{
	/** @var \App\Model\Cashier $cashier */
	protected $cashier;

	/** @before */
	public function setup(): void
	{
		$this->cashier = new Cashier('fname', 'lname', 'bole 04', '+251911223344', 'emp@ourmail.com');
	}

	/** @after */
	public function cleanup()
	{
		$this->cashier = null;
	}

	/** @test */
	public function can_create_cashier()
	{
		$this->assertEquals($this->cashier->GetFirstName(), 'fname');
		$this->assertEquals($this->cashier->GetLastName(), 'lname');
		$this->assertEquals($this->cashier->GetAddress(), 'bole 04');
		$this->assertEquals($this->cashier->GetPhonenumber(), '+251911223344');
		$this->assertEquals($this->cashier->GetEmail(), 'emp@ourmail.com');
	}
	
	/** @test */
	public function can_set_first_name()
	{
		$this->cashier->SetFirstName('Maya');
		$this->assertEquals($this->cashier->GetFirstName(), 'Maya');
	}

	/** @test */
	public function can_set_last_name()
	{
		$this->cashier->SetLastName('Girma');
		$this->assertEquals($this->cashier->GetLastName(), 'Girma');
	}

	/** @test */
	public function can_set_full_name()
	{
		$this->cashier->SetFullName('another', 'name');
		$this->assertEquals('another name', $this->cashier->GetFullName());
	}

	/** @test */
	public function can_set_phonenumber()
	{
		$this->cashier->SetPhonenumber('+251910203040');
		$this->assertEquals('+251910203040', $this->cashier->GetPhonenumber());
	}

	/** @test */
	public function can_set_address()
	{
		$this->cashier->SetAddress('gendegara');
		$this->assertEquals($this->cashier->GetAddress(), 'gendegara');
	}

	/** @test */
	public function can_set_email()
	{
		$this->cashier->SetEmail('mail@domain.com');
		$this->assertEquals($this->cashier->GetEmail(), 'mail@domain.com');
	}
}