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
		$this->cashier = new Cashier('name', 'bole 04', '+251911223344');
	}

	/** @after */
	public function cleanup()
	{
		$this->cashier = null;
	}

	/** @test */
	public function can_set_name()
	{
		$this->cashier->SetName('another name');
		$this->assertEquals('another name', $this->cashier->GetName());
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
}