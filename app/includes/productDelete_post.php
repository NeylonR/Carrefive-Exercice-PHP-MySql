<?php
session_start();
require 'config.php';

$product_id = filter_input(INPUT_POST, 'product_id');
$token = filter_input(INPUT_POST, 'csrf_token');
$resultDisplay = fetchProductJoinUser($db, $product_id, 'seller_id');

if(!$resultDisplay){
    header('location:../index.php');
    exit();
}

if($_SESSION['user'] !== $resultDisplay['username']){
header('location:../index.php?error=unauthorizedUser');
exit();
}

if($_SESSION['token'] !== $token){
header('location:../index.php?error=token');
exit();
}
deleteProductWithOrder($db, $product_id);
header('location:../index.php?success=deleted');
?>