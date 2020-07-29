<?php

namespace App\Controller;

use App\Library\Abstraction\Controller as Controller;
use App\Model\Customer as Customer;
use App\Library\Database as Database;

class CustomerController extends Controller
{
	const TABLE_NAME = "customer";

	public function __construct()
	{
		## Obvious, Isn't it...
		parent::__construct();
	}

	public static function &Create(string $name, string $address, string $phonenumber)
	{
		$name = htmlspecialchars(strip_tags($name));
		$address = htmlspecialchars(strip_tags($address));
		$phonenumber = htmlspecialchars(strip_tags($phonenumber));

		$customer = new Customer($name, $address, $phonenumber);

		$db = (new Database())->getInstance();

		$query = "INSERT INTO "
			. CustomerController::TABLE_NAME .
			" SET
					name=:name, address=:address, phonenumber=:phonenumber";
		$stmt = $db->prepare($query);

		// binding
		// $stmt->bindParam(":id", $id);
		$stmt->bindParam(":name", $name);
		$stmt->bindParam(":address", $address);
		$stmt->bindParam(":phonenumber", $phonenumber);

		if ($stmt->execute()) {
			$customer->setId($db->lastInsertId());
			return $customer;
		}

		return NULL;
	}
	public static function &Read(string $id)
	{
		$query = "SELECT * FROM " . CustomerController::TABLE_NAME . " WHERE id=? LIMIT 0, 1";

		$db = (new Database())->getInstance();

		$stmt = $db->prepare($query);
		$stmt->bindParam(1, $id);

		$stmt->execute();

		if ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
			$customer = new Customer(
				$row["name"],
				$row["address"],
				$row["phonenumber"]
			);

			$customer->setId($row["id"]);

			return $customer;
		}

		return NULL;
	}
	## TODO: Add Paged Returns
	public static function &ReadAll(int $page = 1)
	{
		$tablename = CustomerController::TABLE_NAME;
		$offset = ($page <= 1) ? 0 : 20 * ($page - 1);
		$query = "SELECT * FROM {$tablename} ORDER BY id LIMIT {$offset}, 20";

		$db = new Database();
		$db = $db->getInstance();

		$stmt = $db->prepare($query);

		$stmt->execute();

		$page_count = (int) ceil(CustomerController::Count() / 20);

		$result = null;

		if ($row = $stmt->fetchAll()) {
			$customer_array = array();
			foreach ($row as $key => $customer) {
				array_push($customer_array, Customer::fromArray($customer));
			}

			$result = [
				"page_count" => $page_count,
				"current_page" => $page,
				"data" => $customer_array
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
	public static function &Update(string $id, string $name, string $address, string $phonenumber)
	{
		$id = htmlspecialchars(strip_tags($id));
		$name = htmlspecialchars(strip_tags($name));
		$address = htmlspecialchars(strip_tags($address));
		$phonenumber = htmlspecialchars(strip_tags($phonenumber));

		$customer = new Customer($name, $address, $phonenumber);
		$customer->setId($id);

		$db = (new Database())->getInstance();

		$query = "	UPDATE " .
			CustomerController::TABLE_NAME .
			" SET
						name = :name,
						address = :address,
						phonenumber = :phonenumber
					WHERE
						id = :id
				";
		$stmt = $db->prepare($query);

		$stmt->bindParam(":id", $id);
		$stmt->bindParam(":name", $name);
		$stmt->bindParam(":address", $address);
		$stmt->bindParam(":phonenumber", $phonenumber);

		if ($stmt->execute()) {
			return $customer;
		}

		return NULL;
	}
	public static function Delete(string $id)
	{
		// delete query
		$query = "DELETE FROM " . CustomerController::TABLE_NAME . " WHERE id = ?";

		$db = new Database();
		$db = $db->getInstance();

		// prepare query
		$stmt = $db->prepare($query);

		// sanitize
		$id = htmlspecialchars(strip_tags($id));

		// bind id of record to delete
		$stmt->bindParam(1, $id);

		// execute query
		if ($stmt->execute()) {
			return true;
		}

		return false;
	}

	public static function Search(string $query)
	{
	}
	public static function Count()
	{
		$countQuery = "SELECT COUNT(*) as count FROM customer";

		$db = new Database();
		$db = $db->getInstance();
		
		$stmt = $db->prepare($countQuery);
		$stmt->execute();
		$row = $stmt->fetch(\PDO::FETCH_ASSOC);

		return $row["count"];
	}
}
