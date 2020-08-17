<?php

namespace App\Controller;

use App\Library\Abstraction\Controller as Controller;
use App\Model\User;

class UserController extends Controller
{
	const TABLE_NAME = "user";

	public function __construct()
	{
		parent::__construct();
	}

	public function Create(string $employee_id, string $username, string $password)
	{
		$employee_id = htmlspecialchars(strip_tags($employee_id));
		$username = htmlspecialchars((strip_tags($username)));
		$password = htmlspecialchars(strip_tags($password));

		$user = new User($username, $password);
		$user->SetEmployeeId($employee_id);
		
		$db = $this->__database->GetInstance();

		$query = "INSERT INTO "
				 . self::TABLE_NAME .
				 " SET
					 employee_id=:employee_id, username=:username, password=:password";
		$stmt = $db->prepare($query);

		$stmt->bindParam(":employee_id", $user->GetEmployeeId());
		$stmt->bindParam(":username", $user->GetUsername());
		$stmt->bindParam(":password", $user->GetPassword());

		if($stmt->execute())
		{
			$user->SetId($db->lastInsertId());
			return $user;
		}

		var_dump($stmt->errorInfo());

		return null;
	}
	public function ReadAll(int $page = 1)
	{
		$offset = ($page <= 1) ? 0 : 20 * ($page - 1);
		$query = "SELECT * FROM " . self::TABLE_NAME . " ORDER BY user_id LIMIT {$offset}, 20";

		$db = $this->__database->GetInstance();

		$stmt = $db->prepare($query);
		$stmt->execute();

		$page_count = (int) ceil($this->Count() / 20);

		$result = null;

		if ($row = $stmt->fetchAll()) {
			$user_array = array();
			foreach ($row as $key => $user) {
				array_push($user_array, User::fromArray($user));
			}

			$result = [
				"page_count" => $page_count,
				"current_page" => $page,
				"data" => $user_array
			];

			return $result;
		}

		$result = [
			"page_count" => $page_count,
			"current_page" => $page,
			"data" => null
		];
		
		return $result;
	}
	public function Read($id)
	{}
	public function Update() {}
	public function Delete() {}
	public function Search() {}
	public function Count()
	{
		$query = "SELECT COUNT(*) as count FROM " . self::TABLE_NAME;

		$db = $this->__database->GetInstance();

		$stmt = $db->prepare($query);
		$stmt->execute();

		$row = $stmt->fetch(\PDO::FETCH_ASSOC);

		return $row["count"];
	}
}