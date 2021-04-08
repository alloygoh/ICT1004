<?php
include_once 'functions.php';
$conn = new mysqli("localhost", "sqldev", "sqldevpass", "dev");
// Check connection
if ($conn->connect_error) {
    $errorMsg = "Connection failed: " . $conn->connect_error;
    $success = false;
} else {
    // Prepare the statement:
    $stmt = $conn->prepare("SELECT * FROM announcements ORDER BY date DESC LIMIT 4");
    // Bind & execute the query statement:
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        // Note that email field is unique, so should only have
        // one row in the result set.
        echo "<table class='table anntab'>";
        echo "<thead>";
        echo "<tr><th scope='col' class='datecol'></th><th scope='col' class='annocol'></th></tr>";
        echo "</thead>";
        echo "</tbody>";
        while($row = $result->fetch_assoc()) {
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
        $stmt->close();
    }else{
        echo "<h5>No announcements!</h5>";
    }
    $conn->close();
}

?>