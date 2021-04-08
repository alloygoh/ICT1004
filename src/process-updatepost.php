<?php
try{
    require_once 'db-config.php';
    require_once 'utils.php';
    
    // Decode the $_POST superglobal from JSON before processing
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

    $errorMsg;
    if(!isset($_POST['postTitle']) || empty($_POST['postTitle'])) {
        http_response_code(500);
        $errorMsg = "Blog title cannot be empty!";
        $err_json = array("errMsg" => $errorMsg);
        echo json_encode($err_json);
        return;
    }

    // THIS POST ID HAS TO BE CHANGED TO ACCEPT DYNAMICALLY
    $post_id = $pid;
    $post_title = $_POST['postTitle'];
    $post_tag = $_POST['postTag'];
    $post_content = $_POST['postContent'];
    $query = $dbh->prepare("UPDATE posts SET title = :title, body = :body, tag=:tag WHERE id = :id");
    $query->bindParam(':title', $post_title);
    $query->bindParam(':body', $post_content);
    $query->bindParam(':tag',$post_tag);
    //$post_id = 20;
    //$post_title = $_POST['postTitle'];
    //$post_content = $_POST['postContent'];
    //$query = $dbh->prepare("UPDATE posts SET title = :title, content = :content WHERE id = :id");
    //$query->bindParam(':title', $post_title);
    //$query->bindParam(':content', $post_content);
    $query->bindParam(':id', $post_id);
    $query->execute();
}catch(PDOException $e){
    http_response_code(500);
    return;
}
?>