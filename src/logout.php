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
    header('Location: index.php',true,302);
    exit();
}
header('Location: my-feed.php',true,302);
?>