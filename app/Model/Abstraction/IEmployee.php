<?php

namespace App\Model\Abstraction;

interface IEmployee
{
	public function SetFirstName($firstname);
	public function SetLastName($lastname);
	public function SetFullName($firstname, $lastname);
	public function SetPhonenumber($phonenumber);
	public function SetAddress($address);
	public function SetEmail($email);
	
	public function GetFirstName();
	public function GetLastName();
	public function GetFullName();
	public function GetPhonenumber();
	public function GetAddress();
	public function GetEmail();
}