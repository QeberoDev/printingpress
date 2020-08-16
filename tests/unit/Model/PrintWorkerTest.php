<?php

use App\Model\PrintWorker;
use PHPUnit\Framework\TestCase;

class PrintWorkerTest extends TestCase
{
	/** @var \App\Model\PrintWorker $printWorker */
	protected $printWorker;

	/** @before */
	public function setup(): void
	{
		$this->printWorker = new PrintWorker('fname', 'lname', 'bole 04', '+251911223344', 'emp@ourmail.com');
	}

	/** @after */
	public function cleanup()
	{
		$this->printWorker = null;
	}

	/** @test */
	public function can_create_printWorker()
	{
		$this->assertEquals($this->printWorker->GetFirstName(), 'fname');
		$this->assertEquals($this->printWorker->GetLastName(), 'lname');
		$this->assertEquals($this->printWorker->GetAddress(), 'bole 04');
		$this->assertEquals($this->printWorker->GetPhonenumber(), '+251911223344');
		$this->assertEquals($this->printWorker->GetEmail(), 'emp@ourmail.com');
	}
	
	/** @test */
	public function can_set_first_name()
	{
		$this->printWorker->SetFirstName('Maya');
		$this->assertEquals($this->printWorker->GetFirstName(), 'Maya');
	}

	/** @test */
	public function can_set_last_name()
	{
		$this->printWorker->SetLastName('Girma');
		$this->assertEquals($this->printWorker->GetLastName(), 'Girma');
	}

	/** @test */
	public function can_set_full_name()
	{
		$this->printWorker->SetFullName('another', 'name');
		$this->assertEquals('another name', $this->printWorker->GetFullName());
	}

	/** @test */
	public function can_set_phonenumber()
	{
		$this->printWorker->SetPhonenumber('+251910203040');
		$this->assertEquals('+251910203040', $this->printWorker->GetPhonenumber());
	}

	/** @test */
	public function can_set_address()
	{
		$this->printWorker->SetAddress('gendegara');
		$this->assertEquals($this->printWorker->GetAddress(), 'gendegara');
	}

	/** @test */
	public function can_set_email()
	{
		$this->printWorker->SetEmail('mail@domain.com');
		$this->assertEquals($this->printWorker->GetEmail(), 'mail@domain.com');
	}
}