<?php

require_once 'db-config.php';

if (!$auth->isLogged()){
    header('Location: index.php',true,302);
    exit();
}elseif ($_SERVER['REQUEST_METHOD'] != 'GET'){
    http_response_code(405);
    die("Method Not Allowed");
}

$shash = $auth->getCurrentSessionHash();
if ($auth->logout($shash)){
    // set the expiration date to one hour ago
    setcookie("phpauth_session_cookie", "", time() - 3600);
    unset($_COOKIE['phpauth_session_cookie']);
    header('Location: index.php',true,302);
    exit();
}
header('Location: my-feed.php',true,302);
?>
