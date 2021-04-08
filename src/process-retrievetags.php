
<?php
try {
    require_once 'db-config.php';
    require_once 'utils.php';
    // Retrieve posts data
    $query = $dbh->prepare("SELECT DISTINCT tag FROM posts WHERE tag IS NOT NULL");
    $query->execute();
    $result = [];
    while($row = $query->fetch()){
        array_push($result, $row['tag']);
    }
    $res_json = array("tagList" => $result);
    echo json_encode($res_json);
} catch(PDOException $e){
    echo e.getMessage();
}
?>