<?php 
require "local.env.php";

$db_string = 'mysql:dbname='.DBNAME.';host='.DBHOST;
try {
    $db = new PDO($db_string, DBUSER, DBPASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch(PDOException $e){
    die("Erreur:".$e->getMessage());
};
