<!DOCTYPE html>
<html lang="en">
<?php include 'head.inc.php'; ?>

<body>
    <?php include "nav.inc.php"; ?>
    <main class="container text-center">
        <form class="form-users" id="user-register" method="post">
            <h1 class="h3 mb-3 font-weight-normal">Member Signup</h1>
            <p>
                Already have an account? Sign in 
                <a href="login.php">here</a>.
            </p>
            <label for="inputFname" class="sr-only">First Name</label>
            <input type="text" id="inputFname" name="inputFname" class="form-control" placeholder="First Name" required autofocus>

            <label for="inputLname" class="sr-only">Last Name</label>
            <input type="text" id="inputLname" name="inputLname" class="form-control" placeholder="Last Name" required>

            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="Email address" required>

            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required>
            <label for="inputPasswordConfirm" class="sr-only">Confirm Password</label>
            <input type="password" id="inputPasswordConfirm" name="inputPasswordConfirm" class="form-control" placeholder="Confirm Password" required>

            <button class="btn btn-lg btn-primary btn-block" id="reg-button" type="submit" value="submit">Sign Up</button>
        </form>
    </main>
</body>

</html>