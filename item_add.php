<?php

require('db_connect.php');

// $codeno = $_POST['codeno'];
$name = $_POST['name'];
$photo = $_FILES['photo'];
$price = $_POST['uniqueprice'];
$discount = $_POST['discount'];
$description = $_POST['description'];
$brand = $_POST['brand'];
$subcategory = $_POST['subcategory'];

$codeno = strtotime("now");

$img_dir = 'images/item/';

$filename = strtotime("now");

$file_exe_array = explode('.', $photo['name']);

$file_exe = $file_exe_array[1];
$fullpath = $img_dir.$filename.'.'.$file_exe;
move_uploaded_file($photo['tmp_name'], $fullpath);

 $sql = "INSERT INTO items(codeno, name, photo, price, discount, description, brand_id, subcategory_id) 
 		VALUES (:value1, :value2, :value3, :value4, :value5, :value6, :value7, :value8)";

// var_dump($sql);
 $stmt = $conn->prepare($sql);
 $stmt->bindParam(':value1', $codeno);
 $stmt->bindParam(':value2', $name);
 $stmt->bindParam(':value3', $fullpath);
 $stmt->bindParam(':value4', $price);
 $stmt->bindParam(':value5', $discount);
 $stmt->bindParam(':value6', $description);
 $stmt->bindParam(':value7', $brand);
 $stmt->bindParam(':value8', $subcategory);

 $stmt->execute();

header('location:item_list.php');


?>

