<?php

require_once 'db-config.php';
require_once 'utils.php';

if ($_SERVER['REQUEST_METHOD'] != 'POST'){
    http_response_code(405);
    die("Method Not Allowed");
}

$errorMsg = "";

// Email
$success = true;
$email = $_POST["inputEmail"];
if (empty($email)) {
    $errorMsg .= "Email is required.<br>";
    $success = false;
} else {
    $email = sanitize_input($_POST["inputEmail"]);
    // Additional check to make sure e-mail address is well-formed.
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMsg .= "Invalid email format.<br>";
        $success = false;
    }
}

// remember me
$remember = 0;
if (isset($_POST['remember'])){
    $remember = 1;
}

// Password
$password = $_POST["inputPassword"];
if (empty($password)) {
    $errorMsg .= "Password is required.<br>";
    $success = false;
} 
if ($success){
    $response = $auth->login($email,$password,$remember);
    $success = !$response['error'];
    $dbmsg = $response['message'];
}

// output
if ($success) {
   setcookie($response['cookie_name'], $response['hash'],$response['expire']);
   header("Location: /my-feed.php",TRUE,302); 
} elseif($dbmsg === "system_error"){
    http_response_code(500);
    die("Internal Server Error");
} else{
   header("Location: /login.php?invalid",TRUE,302); 
}
?>