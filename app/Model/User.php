<?php declare(strict_types=1);

namespace App\Model;

use UserTest;

class User
{
	private $firstname, $lastname, $email;

	public function __construct()
	{
		$this->firstname = null;
		$this->lastname = null;
		$this->email = null;
	}

	public function setFirstName(string $name): void
	{
		$this->firstname = trim($name);
	}
	public function setLastName(string $name): void
	{
		$this->lastname = trim($name);
	}
	public function setEmail(string $email): void
	{
		$this->email = $email;
	}

	public function getFirstName(): string
	{
		return $this->firstname;
	}
	public function getLastName(): string
	{
		return $this->lastname;
	}
	public function getFullName(): string
	{
		return $this->firstname . " " . $this->lastname;
	}
	public function getEmail(): string
	{
		return $this->email;
	}
	public function getEmailVariables(): array
	{
		return [
			'full_name' => $this->getFullName(),
			'email' => $this->getEmail()
		];
	}
}