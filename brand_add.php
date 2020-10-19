<?php

require('db_connect.php');

$name = $_POST['name'];
$logo = $_FILES['logo'];

$img_dir = 'images/brand/';

$filename = strtotime("now");

// var_dump($filename);

$file_exe_array = explode('.', $logo['name']);

// var_dump($file_exe_array);

$file_exe = $file_exe_array[1];
$fullpath = $img_dir.$filename.'.'.$file_exe;
move_uploaded_file($logo['tmp_name'], $fullpath);

 $sql = "INSERT INTO brand (name, logo) VALUES (:value1, :value2)";
 $stmt = $conn->prepare($sql);
 $stmt->bindParam(':value1', $name);
 $stmt->bindParam(':value2', $fullpath);
 	$stmt->execute();

header('location:brand_list.php');

?>