<?php

require_once 'db-config.php';
require_once 'utils.php';

if(!$auth->isLogged()){
    header('Location: /index.php');
    exit();
}

$cuid = $auth->getCurrentUID();
$sql = sprintf("select p.*, u.fname from posts p inner join phpauth_users u where p.tag in (select tag from following where user_id=%s) and p.op=u.id",$cuid);
$response = $dbh->query($sql)->fetchAll();
$mapping = []
?>
<!DOCTYPE html>
<html lang="en">
<?php include "head.inc.php" ?>
<body>
    <?php include "log-nav.inc.php" ?>
    <span id="counter" hidden></span>
    <main class = "container">
        <br>
        <!--Announcement should work based on keith's code but doesnt so i commented it out for now
        <div class="announcementbox">
            <h2>Announcements</h2>
            <?php
            //include "get-announcements.php";
            ?>
        </div>-->

        <article>
            <h1 class="h2 mb-3">Your followed posts</h1>
            <div id="cardcontainer">
                <?php 
                foreach ($response as $row){
                    echo "<a href='individualpage.php?post=" . $row["ID"] . "'>" . PHP_EOL;
                    echo "<div class='card'>" . PHP_EOL;
                    echo "<div class='card-body'>" . PHP_EOL;
                    echo '<h2 class="h4">' . sanitize_input($row["title"]) . "</h2>" . PHP_EOL;
                    echo "<p class='card-title myowncardtitle'>&ensp;" . "u/" . sanitize_input($row["fname"]) . "</p>" . PHP_EOL;
                    if ($row['is_archived'] === '1'){
                        echo "<p class='card-title myowncardtitle'>&ensp;Archived</p>" . PHP_EOL;
                    }
                    echo "<p class='card-title myowncardtitle'>&ensp;&ensp;" . $row["likes"] . " Upvotes" . "</p>" . PHP_EOL;
                    echo "<br><br>";
                    if(strlen($row["body"]) < 1023){
                        echo "<p class='card-text'>" . substr(nl2br(sanitize_input(strip_tags($row["body"]))),0, 1023) . "</p>";
                    }else{
                        echo "<p class='card-text'>" . nl2br(sanitize_input(strip_tags($row["body"]))) . "..." . "</p>";
                    }
                    echo "</div>";
                    echo "</div></a><br>";

                }
                ?>
            </div>
        </article>
        <br>
    </main>
    </body>

</html>

