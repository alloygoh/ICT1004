<?php

require_once 'db-config.php';

if ($_SERVER['REQUEST_METHOD'] ==  'GET'){
    $key = basename($_SERVER['REQUEST_URI']);
    $response = $auth->getRequest($key,'reset');
    $success = !$response['error'];
}
?>
<!DOCTYPE html>
<html lang="en">
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
        <form class="form-users" method="post" action="/process-reset.php">
            <h1 class="h3 mb-3 font-weight-normal">Enter New Password</h1>
            
            <label for="cPass" class="sr-only">New Password</label>
            <input type="password" id="cPass" name="newPass" class="form-control" placeholder="New Password" required autofocus>
            <label for="cPassConfirm" class="sr-only">Confirm Password</label>
            <input type="password" id="cPassConfirm" name="newPassConfirm" class="form-control" placeholder="Confirm Password" required>
           
            <input type="hidden" name="request-key" value="<?php echo $key; ?>"> 
            <button class="btn btn-lg btn-primary btn-block btn-cst-marg" type="submit" value="submit">Submit</button>
        </form>
    </main>
</body>