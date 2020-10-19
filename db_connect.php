<?php 

 $servername = "localhost";
 $dbname = "batch18_pos";
 $user = "root";
 $password = "";

$dsn = "mysql:host=$servername;dbname=$dbname";

$pdo = new PDO($dsn,$user,$password);

try {

	$conn = $pdo;

	// set the PDO Error Mode to exception

	$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	
	// echo "Connected Successfully";
	
} catch (Exception $e) {

	echo "Connection Fail".$e->getMessage();
	
}


?>