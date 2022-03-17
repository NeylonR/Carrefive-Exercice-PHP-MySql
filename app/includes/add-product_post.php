<?php
session_start();
require 'config.php';
isConnected();

if(empty($_POST['nameProduct']) || empty($_POST['description']) || empty($_POST['stock']) || empty($_POST['price'])){
    echo "Missing out one input.";
    header('location: ../add-products.php?error=missingInput');
}else{
    $nameProduct = htmlspecialchars($_POST['nameProduct']);
    $description = htmlspecialchars($_POST['description']);
    $price =(float) htmlspecialchars($_POST['price']);
    $dlc = htmlspecialchars($_POST['dlc'])?:NULL;
    // $photo = $_POST['photo']?'assets/img/'.$_POST['photo']:'https://via.placeholder.com/150';
    $nameCategory =(int) htmlspecialchars($_POST['nameCategory']);
    $stock =(int) htmlspecialchars($_POST['stock']);
    $photo = $_FILES['photo'];

    if($photo['size'] > 0 && $photo['size'] < 4000000){
        $valid_ext = ['png','jpg','jpeg','gif'];
        $valid_type = ['image/png','image/jpg','image/jpeg','image/gif'];
        $get_ext = strtolower(substr(strrchr($photo['name'],'.'),1));
        if(!in_array($get_ext, $valid_ext)){
            header('location: ../add-products.php?error=invalidImageExtension');
            exit();
        }
        if(!in_array($photo['type'], $valid_type)){
            header('location: ../add-products.php?error=invalidImageType');
            exit();
        }
        $image_path = '../public/uploads/'.uniqid().'/'.$photo['name'];
        $image_path_insert = substr(strstr(($image_path),'/'),1);
        mkdir(dirname($image_path));

        if(!move_uploaded_file($photo['tmp_name'], $image_path)){
            header('location: ../add-products.php?error=uploadError');
            exit();
        }
    } else{
        $image_path_insert = 'public/uploads/noimg.png';
    }

    if(strlen($nameProduct) < 5 || strlen($nameProduct) > 30){
        header('location: ../add-products.php?error=nameLength');
    } else if(strlen($description) < 4 || strlen($description) > 242){
        header('location: ../add-products.php?error=descriptionLength');
    } else if(strlen($price) < 1 || strlen($price) > 8 || $price < 0){
        header('location: ../add-products.php?error=price');
    } else if(strlen($stock) < 1 || strlen($stock) > 8 || $stock < 0){
        header('location: ../add-products.php?error=stock');
    } else{
        $resultVerif = fetchNamePrice($db, $nameProduct);
        $resultUsername = fetchUser($db, $_SESSION['user']);
    
        if($resultVerif){
            header('location: ../add-products.php?error=dupe');
        } else{
            addProductInsert($db, $nameProduct, $nameCategory, $description, $price, $image_path_insert, $dlc, $stock, $resultUsername);
            header('location:../index.php?success=created');
        }
    }
}
?>