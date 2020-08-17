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

		$sql = "SELECT * FROM " . self::TABLE_NAME . " WHERE admin_id=:id";
		$stmt = $db->prepare($sql);

		$stmt->bindParam('id', $id);

		$stmt->execute();

		$admin = null;
		if($row = $stmt->fetch(\PDO::FETCH_ASSOC))
		{
			$admin = Admin::FromArray($row);
			return $admin;
		}

		return null;
	}
	public static function ReadAll(int $page = 1) {}
	public static function Update(int $id, string $username, string $password) {}
	public static function Search(array $neddle) {}
	public static function Count()
	{
		$db = new Database();
		$db = $db->GetInstance();
		
		$sql = "SELECT COUNT(*) AS count FROM " . self::TABLE_NAME;
		$stmt = $db->prepare($sql);

		$stmt->execute();
		$row = $stmt->fetch(\PDO::FETCH_ASSOC);

		return $row['count'];
	}
	public static function Delete(int $id)
	{
		$db = new Database();
		$db = $db->GetInstance();

		$sql = "DELETE FROM " . self::TABLE_NAME . " WHERE admin_id=:id";
		$stmt = $db->prepare($sql);
		$stmt->bindParam('id', $id);

		if($stmt->execute()) return true;
		return false;
	}
	public static function UsernameExists(string $username)
	{
		$username = htmlspecialchars(strip_tags($username));
		
		$db = new Database();
		$db = $db->GetInstance();

		$sql = "SELECT * FROM " . self::TABLE_NAME . " WHERE username = :username";
		$stmt = $db->prepare($sql);

		$stmt->bindParam('username', $username);

		try
		{
			$stmt->execute();
			if($row = $stmt->fetch(\PDO::FETCH_ASSOC))
			{
				return true;
			}
		} catch (\PDOException $exc)
		{
			throw $exc;
		}

		return false;
	}
}