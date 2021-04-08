<?php
try {
    require_once 'db-config.php';
    require_once 'utils.php';
    
    $_POST = json_decode(file_get_contents("php://input"),true);
    $pid = (int)$_POST['postID'];
    if (empty($pid) || !isset($pid)){
        http_response_code(500);
        $errorMsg = "Invalid ID";
        $err_json = array("errMsg" => $errorMsg);
        echo json_encode($err_json);
        return;
    }
    $qcheck = $dbh->prepare("select op from posts where id = :pid");
    $qcheck->bindParam(':pid',$pid,PDO::PARAM_INT);
    $qcheck->execute();
    $author = (int)$qcheck->fetchColumn();

    if($author != $auth->getCurrentUID()){
        http_response_code(500);
        $errorMsg = "You are not allowed to perform this operation";
        $err_json = array("errMsg" => $errorMsg);
        echo json_encode($err_json);
        return;
    }
    
    // Retrieve posts data
    $post_id = $pid;
    $query = $dbh->prepare("SELECT * FROM posts WHERE id=:id");
    $query->bindParam(':id', $post_id);
    $query->execute();
    $row = $query->fetch();
    $res_json = array("postTitle" => $row['title'], "postContent" => $row['body'], "postTag" => $row['tag'], "isArchived" => $row['is_archived']);
    echo json_encode($res_json);
} catch(PDOException $e){
    http_response_code(500);
    //echo e.getMessage();
}
?>