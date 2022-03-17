<?php 
require 'config.php';

if(empty($_POST['username']) || empty($_POST['password']) || empty($_POST['password2'])){
    echo "Missing out one input.";
    header('location: ../sign-up.php?error=missingInput');
} else{
    $username = strtolower(trim(htmlspecialchars($_POST['username'])));
    $password = trim(htmlspecialchars($_POST['password']));
    $password2 = trim(htmlspecialchars($_POST['password2']));
}

if(strlen($username) < 5 || strlen($username) > 30){
    header('location: ../sign-up.php?error=nameLength');
} else if(strlen($password) < 4 || strlen($password) > 30){
    header('location: ../sign-up.php?error=passLength');
} else{
    $resultVerif = fetchUser($db, $username);

    if($resultVerif){
        header('location: ../sign-up.php?error=userDupe');
        exit();
    } else if($password !== $password2){
        header('location: ../sign-up.php?error=passwordConfirmation');
        exit();
    } else{
        $password = password_hash($password, PASSWORD_DEFAULT);
        $resultInsert = signUp($db, $username, $password);
        if($resultInsert){
            header('location:../sign-in.php');
            exit();
        }else{
            header('location: ../sign-up.php?error=warning');
            exit();
        }
    }
}
?>