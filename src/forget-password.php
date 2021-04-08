<?php 
require_once 'db-config.php';
require_once 'utils.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $success = false;
    if (!empty($_POST['cEmail'])){
        $email = sanitize_input($_POST['cEmail']);
        $response = $auth->requestReset($email,true);
        $success = !$response['error'];
    }
    header('Location: /forget-password.php?success',true,302);
    exit();
} 
?>

<!DOCTYPE html>
<html lang="en">
<?php include 'head.inc.php'; ?>
<body>
    <?php include "nav.inc.php"; ?>
    <main class="container text-center">
        <?php 
            if (isset($_GET['success'])){
                echo '<div class="alert alert-success" role="alert">An email will be sent to you if your email address is registered!</div>';
            } elseif (isset($_GET['invalid'])){
                echo '<div class="alert alert-danger" role="alert">Invalid email or email address not found!</div>';
            }
        ?>
        <form class="form-users" method="post">
            <h1 class="h3 mb-3 font-weight-normal">Reset Password</h1>
            
            <label for="cEmail" class="sr-only">Email address</label>
            <input type="email" id="cEmail" name="cEmail" class="form-control" placeholder="Email address" required autofocus>
            
            <button class="btn btn-lg btn-primary btn-block btn-cst-marg" type="submit" value="submit">Reset</button>
        </form>
    </main>
</body>