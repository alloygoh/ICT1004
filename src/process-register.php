<?php

require_once 'db-config.php';
require_once 'utils.php';

if ($_SERVER['REQUEST_METHOD'] != 'POST'){
    http_response_code(405);
    die("Method Not Allowed");
}


// Email
$email = $errorMsg = "";
$success = true;
if (empty($_POST["inputEmail"])) {
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

// First Name
$fname = "";
if (empty($_POST["inputFname"])) {
    $errorMsg .= "First Name is required.<br>";
    $success = false;
} else {
    $fname = sanitize_input($_POST["inputFname"]);
}

// Last Name
$lname = "";
if (empty($_POST["inputLname"])) {
    $errorMsg .= "Last Name is required.<br>";
    $success = false;
} else {
    $lname = sanitize_input($_POST["inputLname"]);
}

// Password
if (empty($_POST["inputPassword"])) {
    $errorMsg .= "Password is required.<br>";
    $success = false;
} else {
    // ensure password same
    $password = $_POST["inputPassword"];
    $password_cfm = $_POST["inputPasswordConfirm"];
    $phash = password_hash($_POST["inputPassword"],PASSWORD_DEFAULT);
    if (!password_verify($password_cfm, $phash)){
        $success = false;
        $errorMsg .= "Passwords do not match";
    }
}

$dbmsg = "";
if ($success){
    $response = $auth->register($email,$password,$password_cfm,["fname"=>$fname,"lname"=>$lname]);
    $success = !$response['error'];
    $dbmsg = $response['message'];
}

// output
if ($success) {
    http_response_code(200);
    echo "SUCCESS";
} elseif($dbmsg !== ""){
    http_response_code(400);
    echo $dbmsg;
} 
else {
    http_response_code(400);
    echo $errorMsg;
}

?>