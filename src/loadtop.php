<?php
    require_once 'db-config.php';
    require_once 'utils.php';
    
    if(isset($_GET['limit'])){
        $limit = sanitize_input($_GET['limit']);
    }else{
        $limit = 5;
    }

    // Prepare the statement:
    $stmt = $dbh->prepare('SELECT p.* , u.fname FROM posts p inner join phpauth_users u where p.is_archived != 1 and p.op=u.id group by p.id ORDER BY p.likes DESC LIMIT :limit');
    // Bind & execute the query statement: 
    $stmt->bindParam(':limit',$limit,PDO::PARAM_INT);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<a href='individualpage.php?post=" . $row["ID"] . "'>";
            echo "<div class='card'>";
            echo "<div class='card-body'>";
            echo '<h2 class="h4">' . sanitize_input($row["title"]) . "</h2>";
            echo "<p class='card-title myowncardtitle'>&ensp;" . "u/" . sanitize_input($row["fname"]) . "</p>";
            echo "<p class='card-title myowncardtitle'>&ensp;&ensp;" . $row["likes"] . " Upvotes" . "</p>";
            echo "<br><br>";
            if(strlen($row["body"]) < 1023){
                echo "<p class='card-text'>" . substr(nl2br(sanitize_input(strip_tags($row["body"]))),0, 1023) . "</p>";
            }else{
                echo "<p class='card-text'>" . nl2br(sanitize_input(strip_tags($row["body"]))) . "..." . "</p>";
            }
            echo "</div>";
            echo "</div></a><br>";
        }
    } 
?>