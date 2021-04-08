<?php
    require_once 'db-config.php';
    require_once 'utils.php';
     // Prepare the statement:
     $stmt = $dbh->prepare("SELECT * FROM announcements ORDER BY date DESC LIMIT 4");
     // Bind & execute the query statement: 
     $stmt->execute();
    if ($stmt->rowCount() > 0) {
        // Note that email field is unique, so should only have
        // one row in the result set. 
        echo "<table class='table anntab'>";
        echo "<thead>";
        echo "<tr><th scope='col' class='datecol'></th><th scope='col' class='annocol'></th></tr>";
        echo "</thead>";
        echo "</tbody>";
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . sanitize_input($row["date"]) . "</td>";
            if(strlen($row["announcement"]) > 150){
                echo "<td><p class='marquee'><span>" . sanitize_input($row["announcement"]) . "</span></p></td>";
            }else{
                echo "<td>" . sanitize_input($row["announcement"]) . "</td>";
            }
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        echo "<div class='viewallann'><a href='allannouncement.php'>View all announcements</a></span>";
    }else{
        echo '<p class="h5">No announcements!</p>';
    } 
?>