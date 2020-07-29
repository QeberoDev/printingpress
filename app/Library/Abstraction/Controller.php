<?php

namespace App\Library\Abstraction;

use App\Library\Database as Database;

abstract class Controller
{
	protected $__database;

	public function __construct()
	{
		$this->__database = new Database();
	}
}