<?php
try{
    require_once 'db-config.php';
    require_once 'utils.php';
    
    $_POST = json_decode(file_get_contents("php://input"),true);
    
    $pid = $_POST['postID'];
    if (empty($pid) || !isset($pid)){
        http_response_code(500);
        $errorMsg = "Invalid ID";
        $err_json = array("errMsg" => $errorMsg);
        echo json_encode($err_json);
        return;
    }
    $qcheck = $dbh->prepare("select op from posts where id = :pid");
    $qcheck->bindParam(':pid',$pid);
    $qcheck->execute();
    $author = (int)$qcheck->fetchColumn();

    if($author != $auth->getCurrentUID()){
        http_response_code(500);
        $errorMsg = "You are not allowed to perform this operation";
        $err_json = array("errMsg" => $errorMsg);
        echo json_encode($err_json);
        return;
    }

    // UPDATE POST_ID
    $post_id = $pid;
    $query = $dbh->prepare("UPDATE posts SET is_archived=1, archived_date = CURRENT_TIMESTAMP WHERE id=:id");
    $query->bindParam(':id',$post_id);
    $query->execute();
}catch(PDOException $e){
    http_response_code(500);
}
?>