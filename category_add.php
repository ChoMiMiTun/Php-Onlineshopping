<?php

require('db_connect.php');

$name = $_POST['name'];
$photo = $_FILES['photo'];

$source_dir = 'images/category/';

$filename = mt_rand(100000, 999999);
	$file_exe_array = explode('.', $photo['name']);

	// var_dump($file_exe_array);
	$file_exe = $file_exe_array[1];

	$fullpath = $source_dir.$filename.'.'.$file_exe;
	move_uploaded_file($photo['tmp_name'], $fullpath);

	$sql = "INSERT INTO categories (name, photo) VALUES(:value1, :value2)";
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':value1', $name);
	$stmt->bindParam(':value2', $fullpath);
	$stmt->execute();

	header('location:category_list.php');

?>