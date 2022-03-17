<?php
session_start();
require 'config.php';
isConnected();
$orderQuantity = intval($_POST['orderQuantity']);
$resultFetchProduct = fetchProduct($db, $_GET['id']);

if(isset($orderQuantity) && !empty($orderQuantity) && $orderQuantity <= $resultFetchProduct['stock_quantity'] && $orderQuantity > 0){
    $resultFetchUser = fetchUser($db, $_SESSION['user']);
    $amount = $orderQuantity;
    $buyer_id = $resultFetchUser['id'];
    $newStock = $resultFetchProduct['stock_quantity'] - $amount;
    updateDB($db, 'stock_quantity', $newStock);
    $order_id = insertOrder($db, $amount, $buyer_id, $_GET['id']);
    header('location: ../order.php?order_id='.$order_id);
    exit();
} 
if($orderQuantity <= 0 || $orderQuantity > $resultFetchProduct['stock_quantity']){
    header('location:../product.php?id='.$_GET['id'].'&error=amount');
    exit();
}
header('location:../product.php?id='.$_GET['id'].'&error=warning');
exit();
?>