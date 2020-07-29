<?php

namespace App\Library\Abstraction;

abstract class Person
{
	protected $_firstname;
	protected $_lastname;
	protected $_address_location;
	protected $_phonenumber;

	public function __construct(string $firstname, string $lastname, $location, string $phonenumber)
	{
		$this->_firstname = $firstname;
		$this->_lastname = $lastname;
		$this->_address_location = $location;
		$this->_phonenumber = $phonenumber;
	}
	
	// getter
	public function &getFistName() {
		return $this->_firstname;
	}
	public function &getLastName() {
		return $this->_lastname;
	}
	public function &getFullname() {
		return $this->_firstname . " " . $this->_lastname;
	}
	public function &getAddress() {
		return $this->_location;
	}
	public function &getPhonenumber() {
		return $this->_phonenumber;
	}
	// setter
	// function &setFirstName();
	// function &setLastName();
	// function &setFullname();
	// function &setAddress();
	// function &setPhonenumber();
}