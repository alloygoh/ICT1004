<?php
    require_once 'db-config.php';
    require_once "utils.php";
?>
<!DOCTYPE html>
<html lang="en">
    <?php include 'head.inc.php'; ?> 
    <body>
    <?php
        if ($auth->isLogged()){
            include "log-nav.inc.php";
        }else {
            include "nav.inc.php";
        }
        if(isset($_GET['post'])){
            $post_id = sanitize_input($_GET['post']);
            $author = null; 
            $stmt = $dbh->prepare("SELECT p.*,u.fname FROM posts p inner join phpauth_users u where p.ID = ? and p.op = u.id");
            // Bind & execute the query statement: 
            $stmt->execute([$post_id]);
            echo "<br>";
            echo "<main class='container indivcard'>";
            echo "<div class='card'>";
            echo "<div class='card-body'>";
            if ($stmt->rowCount() > 0) {
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '<h1 class="h3">' . sanitize_input($row["title"]) . "</h1>";
                    echo "<p class='card-title myowncardtitle'>&ensp;" . "u/" . sanitize_input($row["fname"]) . "</p>";
                    if ($row['is_archived'] === '1'){
                        echo "<p class='card-title myowncardtitle'>&ensp;Archived</p>" . PHP_EOL;
                    }
                    echo "<p class='card-title myowncardtitle'>&ensp;&ensp;" . $row["likes"] . " Upvotes" . "</p>";
                    echo "<p class='card-title myowncardtitle'>&ensp;&ensp;<b>" . sanitize_input($row["tag"]) . "</b></p>";
                    echo "<br><br>";
                    echo $row["body"];
                    $author = sanitize_input($row["op"]);
                }
            }
            echo "<br><br>";
            //if ($auth->islogged()){
                //do smth
            //}else{
                //dont display upvote
            if($auth->islogged()){
                $cuid = $auth->getCurrentUID();
                $stmt = $dbh->prepare("select * from user_upvoted where user = :uid");
                $stmt->bindParam(':uid',$cuid);
                $stmt->execute();
                if ($stmt->rowCount() > 0){
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $upvotes = $row["upvoted"];
                    // 0 = first vote, 1 = unvote, 2 = other vote, 3 = user never voted anything before fresh entry
                    // upvote = 0, downvote = 1
                    if(strpos($upvotes, $post_id) !== false){
                        echo '<button type="button" onclick="handlevote(\''.$cuid.'\', '.$post_id.', 1, 0)" class="btn btn-outline-success">Upvote</button>';
                        echo '<button type="button" onclick="handlevote(\''.$cuid.'\', '.$post_id.', 2, 1)" class="btn btn-danger">Downvote</button>';
                    }else if(strpos($row["downvoted"], $post_id) !== false){
                        echo '<button type="button" onclick="handlevote(\''.$cuid.'\', '.$post_id.', 2, 0)" class="btn btn-success">Upvote</button>';
                        echo '<button type="button" onclick="handlevote(\''.$cuid.'\', '.$post_id.', 1, 1)" class="btn btn-outline-danger">Downvote</button>';
                    }else{
                        echo '<button type="button" onclick="handlevote(\''.$cuid.'\', '.$post_id.', 0, 0)" class="btn btn-success">Upvote</button>';
                        echo '<button type="button" onclick="handlevote(\''.$cuid.'\', '.$post_id.', 0, 1)" class="btn btn-danger">Downvote</button>';
                    }
                }else{
                    echo '<button type="button" onclick="handlevote(\''.$cuid.'\', '.$post_id.', 3, 0)" class="btn btn-success">Upvote</button>';
                    echo '<button type="button" onclick="handlevote(\''.$cuid.'\', '.$post_id.', 3, 1)" class="btn btn-danger">Downvote</button>';
                }
            }
            echo "</div></div>";
            if ($author!=null && $author == $auth->getCurrentUID()){
                echo '<div>' . PHP_EOL;
                echo sprintf('<a href="/updatepost.php?id=%s" id="update-btn" class="btn btn-outline-dark" role="button">Update Post</a>',$post_id);
                echo '</div>' . PHP_EOL;
            }
            echo "</main>";
        } else{
            header('Location: /my-feed.php',true,302);
            exit();
        }
?>
    </body>
</html>


