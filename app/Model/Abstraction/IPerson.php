<?php

namespace App\Model\Abstraction;

interface IPerson
{
	public function SetName($name);
	public function SetAddress($address);
	public function SetPhonenumber($phonenumber);

	public function GetName();
	public function GetAddress();
	public function GetPhonenumber();
}