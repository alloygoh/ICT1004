<html lang="en">
    <head>
        <title>Title of page</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet"    
              href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"    
              integrity=        "sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
              crossorigin="anonymous">
        <link rel="stylesheet" href="css/main.css">
        <!--jQuery-->
        <script defer    
            src="https://code.jquery.com/jquery-3.4.1.min.js"    
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="    
            crossorigin="anonymous">
        </script>
        <!--Bootstrap JS--> 
        <script defer    
                src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"    
                integrity="sha384-6khuMg9gaYr5AxOqhkVIODVIvm9ynTT5J4V1cfthmT+emCG6yVmEZsRHdxlotUnm"    
                crossorigin="anonymous">
        </script>
        <script defer src="js/main.js">
            </script>
        <!--Custom JS -->
    </head>
    <body>
<?php
    include_once 'functions.php';
    include "nav.inc.php";
    echo "<main class='container'><br><br>";
    $conn = new mysqli("localhost", "root", "root", "proj");
    // Check connection 
    if ($conn->connect_error) {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $success = false;
    } else {
        // Prepare the statement:
        $stmt = $conn->prepare("SELECT * FROM announcements ORDER BY date DESC");
        // Bind & execute the query statement: 
        $stmt->execute();
        $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        // Note that email field is unique, so should only have
        // one row in the result set. 
        while($row = $result->fetch_assoc()) {
            echo "<p>".$row["date"]."</p>";
            echo "<p style='word-break: break-all;'>".$row["announcement"]."</p>";
        }

        $stmt->close();
    }else{
        echo "<h5>No announcements!</h5>";
    } 
    $conn->close();
    }
    echo "</main>";

?>
    </body>
</html>