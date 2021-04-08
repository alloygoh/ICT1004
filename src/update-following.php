<?php

require_once 'db-config.php';
require_once 'utils.php';

if (!$auth->isLogged()) {
  header('Location: /login.php', true, 302);
  exit();
}
$cuid = $auth->getCurrentUID();
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $sql = "INSERT INTO following (user_id,tag) values (?,?)";
    if (empty($_POST['newtag']) || $_POST['newtag'] == 'Choose...'){
        header('Location: /update-following.php', true, 302);
        exit();
    }
    $tag = sanitize_input($_POST['newtag']);
    $success = $dbh->prepare($sql)->execute([$cuid,$tag]);
    if ($success){
        header('Location: /update-following.php?success', true, 302);
        exit();
    }
    header('Location: /update-following.php?invalid', true, 302);
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<?php include 'head.inc.php'; ?>

<body>
    <?php include "log-nav.inc.php"; ?>
    <main class="container text-center">
        <?php 
            if (isset($_GET['invalid'])){
                echo '<div class="alert alert-danger">Update Failed</div>';
            }elseif (isset($_GET['success'])){
                echo '<div class="alert alert-success">Update Success</div>';
            }
        ?>
        <form id="form-following" method="post" action="/update-following.php">
            <h1 class="h3 m-3 font-weight-normal">Add new tags to follow</h1>
            <div class="input-group mb-3 justify-content-center">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect">Options</label>
                </div>
                <select class="custom-select col-5" name="newtag" id="inputGroupSelect">
                    <option selected>Choose...</option>
                    <?php
                        $sql = sprintf('select distinct tag from posts where tag not in (select tag from following where user_id = %s)',$cuid);
                        foreach ($dbh->query($sql) as $row) {
                            $ctag = sanitize_input($row['tag']);
                            echo sprintf('<option value="%s">%s</option>',$ctag,$ctag);
                        }
                    ?>
                </select>
            </div>
            <button class="btn btn-primary btn-cst-marg" type="submit" value="submit">Save Changes</button>
        </form>
    </main>
</body>

</html>