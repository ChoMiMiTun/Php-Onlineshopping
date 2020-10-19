<?php

require('db_connect.php');

$id = $_POST['id'];
$name = $_POST['name'];


	$sql = "UPDATE subcategories SET name=:value1 WHERE id=:value2";
	$stmt= $conn->prepare($sql);
	$stmt->bindParam(':value1', $name);
	$stmt->bindParam(':value2', $id);
	$stmt->execute();

	header('location:subcategory_list.php');


?>