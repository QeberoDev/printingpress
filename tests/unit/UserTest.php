<?php

use App\Model\User as User;

class UserTest extends \PHPUnit\Framework\TestCase
{
	public function setUp(): void
	{
		$this->user = new User('1', 'empname1', 'emppass1');
	}
}