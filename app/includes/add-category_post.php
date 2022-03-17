<?php
require 'config.php';
isConnected();

if(empty($_POST['nameCategory'])){
    header('location: ../add-category.php?error=missingInput');
}else{
    $nameCategory = htmlspecialchars($_POST['nameCategory']);
    if(strlen($nameCategory) < 5 || strlen($nameCategory) > 30){
        header('location: ../add-category.php?error=nameLength');
    } else{
        $resultVerif = fetchLabel($db, $nameCategory);
        if($resultVerif){
            header('location: ../add-category.php?error=dupe');
        } else{
            insertCategory($db, $nameCategory);
            header('location:../index.php?success=category');
        }
    } 
}
?>