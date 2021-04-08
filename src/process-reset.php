<?php

require_once 'db-config.php';

$key = $_POST['request-key'];

// Password
if (empty($_POST['newPass']) || empty($_POST['newPassConfirm'])){
   header('Location: /reset.php/'.$key, true, 302);
   exit();
}
$pass = $_POST['newPass'];
$passConfirm = $_POST['newPassConfirm'];

$response = $auth->resetPass($key, $pass,$passConfirm);
$success = !$response['error']

?>
<!DOCTYPE html>
<html>
<?php include 'head.inc.php'; ?>
<body>
    <?php include "nav.inc.php"; ?>
    <main class="container text-center">
        <?php 
            if (!$success){
                echo '<div class="alert alert-danger">' . $response['message'] . '</div>', PHP_EOL;
                echo '</main>',PHP_EOL;
                echo '</body>';
                exit();
            }
        ?>
        <div class="alert alert-success">Password Successfully Reset!</div>
    </main>
</body>