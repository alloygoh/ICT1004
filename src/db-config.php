<?php
require_once 'vendor/autoload.php';
use PHPAuth\Config as PHPAuthConfig;
use PHPAuth\Auth as PHPAuth;
$parser = parse_ini_file('../secrets/db-config.ini');
try{
    $dbh = new PDO("mysql:host=".$parser['servername'].";dbname=".$parser['dbname'],$parser['username'],$parser['password']);
} catch (PDOException $e){
    die('DB Error');
}
$config = new PHPAuthConfig($dbh);
$auth = new PHPAuth($dbh,$config);
?>

