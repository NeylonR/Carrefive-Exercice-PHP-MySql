<?php
require 'config.php';

if(in_array('',$_POST)){
    echo "Missing out one input.";
    header('location:../sign-in.php?error=missingInput')
;} else{
    $username = trim(htmlspecialchars($_POST['username']));
    $password = trim(htmlspecialchars($_POST['password']));
}

$resultVerif = fetchUser($db, $username);
if($resultVerif && password_verify($password,$resultVerif['password']) ){
    session_start();
    $_SESSION['user']=$username;
    $_SESSION['token'] = md5(uniqid('csrf', true));
    header('location:../index.php');
 } else{
    header('location:../sign-in.php?error=wrongId');
 }
?>