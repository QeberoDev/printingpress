<?php

namespace App\Controller;

use App\Library\Abstraction\Controller;
use App\Library\Database;
use App\Model\Admin;
use PDOException;

class AdminController extends Controller
{
	const TABLE_NAME = "admin";

	public function __construct()
	{
		parent::__construct();
	}

	public static function Create(string $username, string $password)
	{
		$username = htmlspecialchars(strip_tags($username));
		$password = htmlspecialchars(strip_tags($password));

		$admin = new Admin($username, $password);

		$db = new Database();
		$db = $db->GetInstance();

		$sql = "INSERT INTO " . self::TABLE_NAME . " SET username=:username, `password`=:password";
		$stmt = $db->prepare($sql);

		$stmt->bindParam("username", $username);
		$stmt->bindParam("password", $password);

		try
		{
			if($stmt->execute()) {
				$admin->SetId($db->lastInsertId());
				return $admin;
			}
		} catch (PDOException $exc)
		{
			throw $exc;
		}

		return null;
	}

	public static function Read(int $id)
	{
		$db = new Database();
		$db = $db->GetInstance();

		
	}
}