<?php
//Helper function that checks input for malicious or unwanted content.
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
function bad_exit($message,$code=400){
    echo $message;
    http_response_code($code);
    exit();
}
?>