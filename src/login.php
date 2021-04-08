<!DOCTYPE html>
<html lang="en">
<?php include 'head.inc.php'; ?>

<body>
    <?php include "nav.inc.php"; ?>
    <main class="container text-center">
    <?php 
        if(isset($_GET["invalid"])){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">Invalid Email or Password';
            echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
            echo '<span aria-hidden="true">&times;</span>';
            echo '</button></div>';
        }
    ?>
        <form class="form-users" action="/process-login.php" method="POST">
            <h1 class="h3 mb-3 font-weight-normal">Member Login</h1>
            <p>
                Not registered? Sign up
                <a href="/register.php">here</a>
            </p>
            <p>
                <a href="/forget-password.php">Forgot your password?</a>
            </p>
            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" name="inputEmail" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" name="inputPassword" id="inputPassword" class="form-control" placeholder="Password" required>
            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" name="remember" value="remember-me"> Remember me
                </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        </form>
    </main>
</body>

</html>