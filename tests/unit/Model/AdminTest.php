<?php

use App\Model\Admin;
use PHPUnit\Framework\TestCase;

class AdminTest extends TestCase
{
	/** @var \App\Model\Admin */
	protected $admin;

	/** @before */
	public function setup(): void
	{
		$this->admin = new Admin('username', 'password');
		$this->admin->SetId(12);
	}

	/** @after */
	public function cleanup()
	{
		$this->admin = null;
	}
	
	/** @test */
	public function can_create_admin()
	{
		$this->assertEquals($this->admin->GetUsername(), 'username');
		$this->assertEquals($this->admin->GetPassword(), 'password');
	}

	/** @test */
	public function can_set_username()
	{
		$this->admin->SetUsername('newuser');
		$this->assertEquals($this->admin->GetUsername(), 'newuser');
	}

	/** @test */
	public function can_set_password()
	{
		$this->admin->SetPassword('anotherpassword');
		$this->assertEquals($this->admin->GetPassword(), 'anotherpassword');
	}

	/** @test */
	public function can_set_created_date()
	{
		$this->admin->SetCreatedDate('22-10-2020');
		$this->assertEquals($this->admin->GetCreatedDate(), '22-10-2020');
	}
}