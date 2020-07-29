<?php declare(strict_types=1);

namespace App\Model;

use UserTest;

class User
{
	private $firstname, $lastname;

	public function __construct()
	{
		$this->firstname = null;
		$this->lastname = null;
	}

	public function setFirstName(string $name): void
	{
		$this->firstname = $name;
	}

	public function getFirstName(): string
	{
		return $this->firstname;
	}

	public function setLastName(string $name): void
	{
		$this->lastname = $name;
	}

	public function getLastName(): string
	{
		return $this->lastname;
	}

	public function getFullName(): string
	{
		return $this->firstname . " " . $this->lastname;
	}
}