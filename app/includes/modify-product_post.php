<?php
session_start();
require 'config.php';
isConnected();
$resultUsername = fetchUser($db, $_SESSION['user']);

if(empty($_POST['nameProduct']) && empty($_POST['description']) && empty($_POST['price']) && empty($_POST['dlc']) && empty($_POST['nameCategory']) && empty($_POST['stock']) && $_POST['stock'] < "0" && $_FILES['photo']['size'] <= 0){
    echo "You need to fill atleast one input.";
}else{
    $nameProduct = htmlspecialchars($_POST['nameProduct']);
    $description = htmlspecialchars($_POST['description']);
    $price =(float) htmlspecialchars($_POST['price']);
    $dlc = htmlspecialchars($_POST['dlc'])?:NULL;
    // $photo = $_POST['photo']?'assets/img/'.$_POST['photo']:'https://via.placeholder.com/150';
    $nameCategory =(int) htmlspecialchars($_POST['nameCategory']);
    $stock =(int) intval($_POST['stock']);
    $photo = $_FILES['photo'];
    $resultVerif = fetchNamePrice($db, $nameProduct);

    if($resultVerif && $resultVerif['name'] = htmlspecialchars($_POST['nameProduct'])){
        header('location:../product_edit.php?error=dupe&id='.$_GET['id']);
        exit();
    } else{ 
        if(!empty($_POST['nameProduct'])){
            if(strlen($nameProduct) < 5 || strlen($nameProduct) > 30){
                header('location: ../product_edit.php?error=nameLength&id='.$_GET['id']);
                exit();
            } else{
                updateDB($db, 'name', $nameProduct);
            } 
        }
        if(!empty($_POST['description'])){
            if(strlen($description) < 4 || strlen($description) > 242){
                header('location: ../product_edit.php?error=descriptionLength&id='.$_GET['id']);
                exit();
            } else{
                updateDB($db, 'description', $description);
            }   
        }
        if(!empty($_POST['price'])){
            if(strlen($price) < 1 || strlen($price) > 8 || $price < 0){
                header('location: ../product_edit.php?error=price&id='.$_GET['id']);
                exit();
            } else{
                updateDB($db, 'price', $price);
            }
        }
        if(!empty($_POST['dlc'])){
            updateDB($db, 'dlc', $dlc);
        }
        
        if($photo['size'] > 0 && $photo['size'] < 4000000){
            $valid_ext = ['png','jpg','jpeg','gif'];
            $valid_type = ['image/png','image/jpg','image/jpeg'];
            $get_ext = strtolower(substr(strrchr($photo['name'],'.'),1));
            if(!in_array($get_ext, $valid_ext)){
                header('location: ../product_edit.php?error=invalidImageExtension&id='.$_GET['id']);
                exit();
            }
            if(!in_array($photo['type'], $valid_type)){
                header('location: ../product_edit.php?error=invalidImageType&id='.$_GET['id']);
                exit();
            }
            $image_path = '../public/uploads/'.uniqid().'/'.$photo['name'];
            $image_path_insert = substr(strstr(($image_path),'/'),1);
            mkdir(dirname($image_path));
    
            if(!move_uploaded_file($photo['tmp_name'], $image_path)){
                header('location: ../product_edit.php?error=uploadError&id='.$_GET['id']);
                exit();
            }

            updateDB($db, 'image', $image_path_insert);
        }

        if(!empty($_POST['nameCategory'])){
            updateDB($db, 'category_id', $nameCategory);
        }
        if(!empty($_POST['stock']) || $_POST['stock'] == "0"){
            if(strlen($stock) < 1 || strlen($stock) > 8 || $stock < 0){
                header('location: ../product_edit.php?error=stock&id='.$_GET['id']);
                exit();
            } else{
                updateDB($db, 'stock_quantity', $stock);
            }          
        }
        updateDB($db, 'modifier_id',$resultUsername['id']);
        header('location:../product.php?id='.$_GET['id'].'&success');
        }
}
?>