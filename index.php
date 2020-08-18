<?php

$host = "mysql:dbname=test;host=127.0.0.1:3308";
$username = "root";
$password = '';

$db = new \PDO($host, $username, $password);

$sql = "SELECT * FROM test_table";

$stmt = $db->prepare($sql);
$stmt->execute();

if($row = $stmt->fetchAll())
{
	foreach($row as $index => $value)
	{
		var_dump($value);
	}
}

echo PHP_EOL;