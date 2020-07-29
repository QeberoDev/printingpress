<?php

use App\Model\User as User;

class UserTest extends \PHPUnit\Framework\TestCase
{
	public function testGetFirstName()
	{
		$user = new User();
		$user->setFirstName('Billy');

		$this->assertEquals($user->getFirstName(), 'Billy');
	}

	public function testGetLastName()
	{
		$user = new User();
		$user->setLastName("Illish");

		$this->assertEquals($user->getLastName(), "Illish");
	}

	public function testGetFullName()
	{
		$user = new User();
		$user->setFirstName("Billy");
		$user->setLastName("Illish");

		$this->assertEquals($user->getFullName(), "Billy Illish");
	}
}