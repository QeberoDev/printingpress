<?php

use App\Model\User as User;

class UserTest extends \PHPUnit\Framework\TestCase
{
	public function setUp(): void
	{
		$this->user = new User();
	}
	
	/** @test */
	public function GetFirstName()
	{
		$this->user->setFirstName('Billy');
		$this->assertEquals($this->user->getFirstName(), 'Billy');
	}
	public function testGetLastName()
	{
		$this->user->setLastName("Illish");
		$this->assertEquals($this->user->getLastName(), "Illish");
	}
	public function testGetFullName()
	{
		$this->user->setFirstName("Billy");
		$this->user->setLastName("Illish");

		$this->assertEquals($this->user->getFullName(), "Billy Illish");
	}
	public function testFirstAndLastNameAreTrimmed()
	{
		$this->user->setFirstName(" Billy   ");
		$this->user->setLastName("    Garrate  ");

		$this->assertEquals($this->user->getFirstName(), "Billy");
		$this->assertEquals($this->user->getLastName(), "Garrate");
	}
	public function testEmailAddressCanBeSet()
	{
		$this->user->setFirstName("Billy");
		$this->user->setLastName("Garrate");
		$this->user->setEmail("billy@email.com");

		$emailVariables = $this->user->getEmailVariables();

		$this->assertArrayHasKey('full_name', $emailVariables);
		$this->assertArrayHasKey('email', $emailVariables);

		$this->assertEquals($emailVariables['full_name'], "Billy Garrate");
		$this->assertEquals($emailVariables['email'], "billy@email.com");
	}
}