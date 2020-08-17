<?php

namespace App\Controller;

# System Libraries
use PDOException;
# My Libraries
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

	public static function Create(string $name, string $phonenumber, string $address = null)
	{
		$name = htmlspecialchars(strip_tags($name));
		if($address) $address = htmlspecialchars(strip_tags($address));
		$phonenumber = htmlspecialchars(strip_tags($phonenumber));
		$phonenumber = str_replace(" ", "", $phonenumber);

		$customer = new Customer($name, $phonenumber);

		if($address) $customer->SetAddress($address);

		$db = (new Database())->GetInstance();

		$query = "INSERT INTO ${self::TABLE_NAME} SET name=:name, address=:address, phonenumber=:phonenumber";
		$stmt = $db->prepare($query);

		// binding
		$stmt->bindParam(":name", $name);
		$stmt->bindParam(":address", $address);
		$stmt->bindParam(":phonenumber", $phonenumber);

		try
		{
			if ($stmt->execute()) {
				$customer->SetId($db->lastInsertId());
				return $customer;
			}
		} catch (PDOException $exc)
		{
			throw $exc;
		}

		return NULL;
	}
	public static function Read(string $id)
	{
		$query = "SELECT * FROM ${self::TABLE_NAME} WHERE customer_id=:id LIMIT 0, 1";

		$db = (new Database())->GetInstance();

		$stmt = $db->prepare($query);
		$stmt->bindParam("id", $id);

		$stmt->execute();

		if ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
			$customer = new Customer(
				$row["name"],
				$row["phonenumber"],
				$row["address"]
			);

			$customer->setId($row["customer_id"]);

			return $customer;
		}

		return NULL;
	}
	## DONE: Add Paged Returns
	public static function ReadAll(int $page = 1)
	{
		$tablename = CustomerController::TABLE_NAME;
		$offset = ($page <= 1) ? 0 : 20 * ($page - 1);
		$query = "SELECT * FROM ${self::TABLE_NAME} ORDER BY customer_id LIMIT {$offset}, 20";

		$db = new Database();
		$db = $db->GetInstance();

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
	public static function Update(string $id, string $name, string $phonenumber, string $address)
	{
		$id = htmlspecialchars(strip_tags($id));
		$name = htmlspecialchars(strip_tags($name));
		$phonenumber = htmlspecialchars(strip_tags($phonenumber));
		if($address) $address = htmlspecialchars(strip_tags($address));

		$customer = new Customer($name, $address, $phonenumber);
		$customer->setId($id);

		$db = (new Database())->GetInstance();

		$query = "UPDATE ${self::TABLE_NAME} SET
				name = :name,
				address = :address,
				phonenumber = :phonenumber
			WHERE
				customer_id = :id";
		$stmt = $db->prepare($query);

		$stmt->bindParam(":id", $id);
		$stmt->bindParam(":name", $name);
		$stmt->bindParam(":address", $address);
		$stmt->bindParam(":phonenumber", $phonenumber);

		if ($stmt->execute()) return $customer;
		return NULL;
	}
	public static function Delete(string $id)
	{
		// delete query
		$query = "DELETE FROM ${self::TABLE_NAME} WHERE customer_id = ?";

		$db = new Database();
		$db = $db->GetInstance();

		// prepare query
		$stmt = $db->prepare($query);

		// sanitize
		$id = htmlspecialchars(strip_tags($id));

		// bind id of record to delete
		$stmt->bindParam(1, $id);

		// execute query
		if ($stmt->execute()) return true;
		return false;
	}
	public static function Search(array $neddle)
	{
		$result = [];

		$db = new Database();
		$db = $db->GetInstance();

		$sql = "SELECT * FROM ${self::TABLE_NAME} WHERE ";

		if(isset($neddle['name'])) {
			$neddle['name'] = '%' . $neddle['name'] . '%';
			$sql .= " name LIKE :name";
			if(count($neddle) > 1) $sql .= " AND";
		}
		if(isset($neddle['phonenumber'])) {
			$neddle['phonenumber'] = '%' . $neddle['phonenumber'] . '%';
			$sql .= " phonenumber LIKE :phonenumber";
			if(count($neddle) > 1 && count($neddle) != 2) $sql .= " AND";
		}
		if(isset($neddle['address'])) {
			$neddle['address'] = '%' . $neddle['address'] . '%';
			$sql .= " address LIKE :address";
		}
		
		$stmt = $db->prepare($sql);
		
		if(isset($neddle['name'])) $stmt->bindParam(':name', $neddle['name']);
		if(isset($neddle['phonenumber'])) $stmt->bindParam(':phonenumber', $neddle['phonenumber']);
		if(isset($neddle['address'])) $stmt->bindParam(':address', $neddle['address']);

		$stmt->execute();

		if($row = $stmt->fetchAll(\PDO::FETCH_ASSOC))
		{
			foreach($row as $index => $customer)
			{
				array_push($result, Customer::fromArray($customer));
			}
		}

		return $result;
	}
	public static function Count()
	{
		$countQuery = "SELECT COUNT(*) as count FROM customer";

		$db = new Database();
		$db = $db->GetInstance();
		
		$stmt = $db->prepare($countQuery);
		$stmt->execute();
		$row = $stmt->fetch(\PDO::FETCH_ASSOC);

		return $row["count"];
	}
}
