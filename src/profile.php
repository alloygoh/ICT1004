<?php

require_once 'db-config.php';

if (!$auth->isLogged()) {
    header('Location: /login.php', true, 302);
    exit();
}

$data = $auth->getCurrentUser();
//id, fname, lname, email, isactive, dt, uid
$fname = $data['fname'];
$lname = $data['lname'];
$email = $data['email'];
?>
<!DOCTYPE html>
<html lang="en">
<?php include 'head.inc.php'; ?>

<body>
    <?php include "log-nav.inc.php"; ?>
    <main class="container text-center">
        <form id="form-profile" method="post" action="/process-profile.php">
            <h1 class="h3 mb-3 font-weight-normal">My Profile</h1>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="changeFname" class="change-label d-flex justify-content-start">First Name</label>
                    <input type="text" id="changeFname" name="changeFname" class="form-control" placeholder="<?php echo $fname ?>" autofocus>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="changeLname" class="change-label d-flex justify-content-start">Last Name</label>
                    <input type="text" id="changeLname" name="changeLname" class="form-control" placeholder="<?php echo $data['lname'] ?>">
                </div>
            </div>           
            <label for="changeEmail" id="labelcEmail" class="change-label d-flex justify-content-start">Email Address</label>
            <input type="email" id="changeEmail" name="changeEmail" class="form-control" placeholder="<?php echo $email ?>" onfocusout="processEmail()">

            <label for="currentPassword" class="change-label d-flex justify-content-start">Current Password</label>
            <input type="password" id="currentPassword" name="currentPassword" class="form-control" placeholder="Current Password">
            <label for="newPassword" class="change-label d-flex justify-content-start">New Password</label>
            <input type="password" id="newPassword" name="newPassword" class="form-control" placeholder="New Password" onfocusout="processPassword()">
            <label for="newPasswordConfirm" class="change-label d-flex justify-content-start">Confirm Password</label>
            <input type="password" id="newPasswordConfirm" name="newPasswordConfirm" class="form-control" placeholder="Confirm Password">

            <button class="btn btn-lg btn-primary btn-block btn-cst-marg" id="profile-submit" type="submit" value="submit">Save Changes</button>
        </form>
    </main>
</body>

</html>

