<?php

require_once 'db-config.php';
require_once 'utils.php';
// bad_exit defined in utils.php

if ($_SERVER['REQUEST_METHOD'] != 'POST'){
    bad_exit("Method Not Allowed",405);
}

if (!$auth->isLogged()){
    header('Location: /login.php',true, 302);
    return;
}

$cuid = $auth->getCurrentUID();

// only treat set form fields as those that needs update

// Email
$email = $errorMsg = "";
$currentpass = "";
$dbmsg = "";
$success = true;
if (!empty($_POST["changeEmail"])) {
    $email = sanitize_input($_POST["changeEmail"]);
    // Additional check to make sure e-mail address is well-formed.
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        bad_exit("Invalid email format.");
    } else{
        if (empty($_POST['currentPassword'])){
            bad_exit("Password not entered");
        }
        $currentpass = $_POST['currentPassword'];
        $response = $auth->changeEmail($cuid,$email, $currentpass);
        $success = !$response['error'];
        if (!$success){
            bad_exit($response['message']);
        }
    }
} 

// First Name
$fname = "";
if (!empty($_POST["changeFname"])) {
    $fname = sanitize_input($_POST["changeFname"]);
    $response = $auth->updateUser($cuid, ['fname'=>$fname]);
    $success = !$response['error'];
    if (!$success){
        bad_exit($response['message']);
    }
} 

// Last Name
$lname = "";
if (!empty($_POST["changeLname"])) {
    $lname = sanitize_input($_POST["changeLname"]);
    $response = $auth->updateUser($cuid, ['lname'=>$lname]);
    $success = !$response['error'];
    if (!$success){
        bad_exit($response['message']);
    }
} 

// Passwords
$currentpass = "";
$newpass = "";
$newpassconfirm = "";
$values = array($_POST["currentPassword"], $_POST["newPassword"], $_POST["newPasswordConfirm"]);
if (!empty($_POST["currentPassword"]) && !empty($_POST["newPassword"]) && !empty($_POST["newPasswordConfirm"]) ) {
    $currentpass = $_POST["currentPassword"];
    $newpass = $_POST["newPassword"];
    $newpassconfirm = $_POST["newPasswordConfirm"];
    $response = $auth->changePassword($cuid, $currentpass, $newpass, $newpassconfirm);
    $success = !$response['error'];
    if (!$success){
        bad_exit($response['message']);
    }
} elseif(count(array_unique($values)) !== 1){
    // inconsistent input
    bad_exit("Inconsistent input in password fields");
}

// output
http_response_code(200);
echo "SUCCESS";
?>
