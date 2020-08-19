<?php

namespace App\Util;

use App\Library\Database;

class DatabaseAction
{
	public static function clear()
	{
		$result = true;
		$db = new Database();

		foreach( $db->GetTables() as $index => $tablename) {
			$sql = "DELETE FROM " . $tablename['Tables_in_printingpress_test'];
			$stmt = $db->GetInstance()->prepare($sql);

			if(!$stmt->execute()) $result = false;
		}

		return $result;
	}
	public static function seed()
	{
		$db = new Database();
		$db = $db->GetInstance();

		$sql = "DELETE * FROM";
		$stmt = $db->prepare($sql);
	}
}