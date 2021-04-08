<?php
include_once 'functions.php';
include_once 'db-config.php';

$conn = new mysqli("localhost", "sqldev", "sqldevpass", "dev");
// Check connection

$temp = json_decode(file_get_contents('php://input'), true);
$type = $temp["type"];
//Define type using json

//echo $type;
$data = $auth->getCurrentUser();
//id, fname, lname, email, isactive, dt, uid
$fname = $data['fname'];

//If "$auth" doesn't work for some reason use the following "hardcode" for testing (Lines 16-19)
//$data = $auth->getCurrentUser(); //COMMENT OUT
//id, fname, lname, email, isactive, dt, uid //
//$fname = "admin"; //UNCOMMENT THIS LINE AND REPLACE "admin" WITH WHATEVER USER

if ($type == "following") {
    $stmt = $conn->prepare("SELECT user_following FROM user_follows WHERE user = '" . $fname . "'");
    // Bind & execute the query statement:
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    //echo $row;
    $sortVar = $row["user_following"];
    //echo $following;
    $col = "op";
}
else if ($type == "tags") {
    //echo "click"; DEBUGGING
    $stmt = $conn->prepare("SELECT user_tags FROM user_follows WHERE user = '" . $fname . "'");
    // Bind & execute the query statement:
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    //echo $row; DEBUG
    $sortVar = $row["user_tags"];
    $col = "tag";
    //echo"click end"; DEBUGGING
}

if ($conn->connect_error) {
    $errorMsg = "Connection failed: " . $conn->connect_error;
    $success = false;
} else {
    // Prepare the statement:
    // colVar will either be tag or (post by) user
    // val will be value to get from table
    $stmt = $conn->prepare("SELECT * FROM posts WHERE " . $col . " IN (" . $sortVar . ") ORDER BY likes DESC ");
    // Bind & execute the query statement:
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<div class='card'>";
            echo "<div class='card-body'>";
            echo "<h4>" . sanitize_input($row["title"]) . "</h4>";
            echo "<h7 class='card-title myowncardtitle'>&ensp;" . "u/" . sanitize_input($row["op"]) . "</h7>";
            echo "<h7 class='card-title myowncardtitle'>&ensp;&ensp;" . $row["likes"] . " Upvotes" . "</h7>";
            echo "</br></br>";
            if(strlen($row["body"]) < 1023){
                echo "<p class='card-text'>" . substr(nl2br(sanitize_input($row["body"])),0, 1023) . "</p>";
            }else{
                echo "<p class='card-text'>" . nl2br(sanitize_input($row["body"])) . "..." . "</p>";
            }
            echo "</div>";
            echo "</div></br>";

        }
        $stmt->close();
    }
    $conn->close();
}
?>
