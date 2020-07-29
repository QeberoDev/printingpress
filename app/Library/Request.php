<?php

namespace App\Library;

class Request {
	private $request = array();

	public function __construct()
	{
		$this->request = $this->initFromHttp();
	}

	public function initFromHttp()
	{
		if(!empty($_POST)) return $_POST;
		if(!empty($_GET)) return $_GET;
		return array();
	}

	public function get(string $name)
	{
		if(!array_key_exists($name, $this->request)) return (bool) false;
		return (string) $this->request[$name];
	}

	public function set(string $name, $value)
	{
		$this->request[$name] = $value;
	}
}