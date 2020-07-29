<?php
namespace App\Test;

## Required Headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: text/html');

$data = file_get_contents("php://input");

var_dump($data);
var_dump($_POST);

if(!empty($data->ping))
{
	return [
		'Welcome' => "To Ethiopia", 
		'Not Welcome' => "To Africa",
		'pinging' => "{$data->ping}"
	];
}

if(!empty($_POST["ping"]))
{
	return [
		'Welcome' => "To Ethiopia", 
		'Not Welcome' => "To Africa",
		'pinging' => "{$_POST['ping']}"
	];
}

return ["nothing"];

class Controller {
	public static function getPost()
	{
		echo "[" . __FILE__ . ", [Line: " . __LINE__ . "]] Class: " . Controller::class . "::" . __METHOD__ . "()";
		var_dump($_POST);

		if(!empty($_POST["ping"]))
		{
			return [
				"What is this man!!" => "This is shit nigga"
			];
		} else {
			return [
				"What is this not" => "A confirmation, is what it is."
			];
		}
	}
	public static function getAnotherPost()
	{
		echo "[" . __FILE__ . ", [Line: " . __LINE__ . "]] Class: " . Controller::class . "::" . __METHOD__ . "()";
		var_dump($_POST);

		if(!empty($_POST["ping"]))
		{
			return [
				"Post is Ping" => "But Ping is nothing"
			];
		} else {
			return [
				"Yep" => "Did you hear that."
			];
		}
	}
}